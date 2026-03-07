<!-- partial:partials/_navbar.html -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="index.html">
            <span style="font-weight: 600; font-size: 18px;">Property Management</span>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="{{ asset('admin/assets/images/logo-mini.svg') }}" alt="logo-mini"
                style="height: 30px; width: auto;">
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <!-- SEARCH BAR -->
        <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                </div>
            </form>
        </div>

        <ul class="navbar-nav navbar-nav-right ml-auto">
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>

            

            <!-- Notifications Dropdown -->
            <li class="nav-item dropdown">

                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-bs-toggle="dropdown">

                    <i class="mdi mdi-bell-outline"></i>

                    @if ($countNotif > 0)
                        <span class="count-symbol bg-danger"></span>
                    @endif

                </a>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list">

                    <h6 class="p-3 mb-0">Notifications</h6>

                    <div class="dropdown-divider"></div>

                    @forelse($notifications as $notif)
                        <a class="dropdown-item preview-item" href="{{ $notif->data['url'] ?? '#' }}">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-info">
                                    <i class="mdi mdi-bell"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject mb-1">
                                    {{ $notif->data['title'] ?? 'Notification' }}
                                </h6>
                                <p class="text-gray mb-0">
                                    {{ $notif->data['message'] ?? '-' }}<br>
                                    <strong>Booking:</strong> {{ $notif->data['booking_code'] ?? '-' }}<br>
                                    <strong>Unit:</strong> {{ $notif->data['unit_name'] ?? '-' }}<br>
                                    <strong>Customer:</strong> {{ $notif->data['customer_name'] ?? '-' }}
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    @empty
                        <p class="p-3 text-center">No Notification</p>
                    @endforelse

                </div>

            </li>


            {{-- AUDIO NOTIFICATION --}}
            <audio id="notifSound">
                <source src="{{ asset('sound/notif.wav') }}" type="audio/mpeg">
            </audio>
            <script>
                document.addEventListener("click", function() {

                    let audio = document.getElementById("notifSound");

                    if (audio) {
                        audio.play().then(() => {
                            console.log("Audio diaktifkan");
                        }).catch(err => {
                            console.log(err);
                        });
                    }

                }, {
                    once: true
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let audio = document.getElementById("notifSound");

                    if (audio) {
                        audio.play().catch(function(error) {
                            console.log("Autoplay diblokir browser");
                        });
                    }
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {

                    let notifCount = {{ $countNotif ?? 0 }};

                    if (notifCount > 0) {

                        let sound = document.getElementById("notifSound");

                        // play sound
                        sound.play().catch(function() {
                            console.log("Autoplay diblokir browser");
                        });

                    }

                });
            </script>

            <!-- Profile Dropdown -->
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{ auth()->user()->name }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="mdi mdi-cached me-2 text-success"></i> Activity Log
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Signout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- partial -->
