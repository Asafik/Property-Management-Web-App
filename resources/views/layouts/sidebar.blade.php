
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">admin</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <!-- MENU MARKETING DENGAN SUB-MENU -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#marketing" aria-expanded="false"
                    aria-controls="marketing">
                    <span class="menu-title">Marketing</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-bullhorn menu-icon"></i>
                </a>
                <div class="collapse" id="marketing">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('marketing.jual-unit') }}">Jual Unit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('marketing.list_pengajuan') }}">User Booking</a>
                        </li>
                    </ul>
                </div>
            </li>


        <!-- MENU PROPERTI DENGAN SUB-MENU -->
       <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#properti"
                    aria-expanded="{{ request()->routeIs('properti*') ? 'true' : 'false' }}"
                    aria-controls="properti">
                <span class="menu-title">Tanah Induk (Land Bank)</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-office-building menu-icon"></i>
            </a>

            <div class="collapse {{ request()->routeIs('properti*') ? 'show' : '' }}" id="properti">
                <ul class="nav flex-column sub-menu">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('properti-all') ? 'active' : '' }}"
                            href="{{ route('properti-all') }}">
                            Semua Tanah
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('properti') ? 'active' : '' }}"
                            href="{{ route('properti') }}">
                            Tambah Tanah (LandBank)
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kavling.*') ? 'active' : '' }}"
                            href="{{ route('kavling.index') }}">
                            Tambah Kavling
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lokasi.*') ? 'active' : '' }}"
                            href="{{ route('lokasi.index') }}">
                            Lokasi
                        </a>
                    </li>

                </ul>
            </div>

            </li>

        <!-- MENU CUSTOMER DENGAN SUB-MENU -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#customer" aria-expanded="false"
                aria-controls="customer">
                <span class="menu-title">User</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-group menu-icon"></i>
            </a>
            <div class="collapse" id="customer">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.tambah_customer') }}">Tambah User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.data') }}">
                            Data User
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.tamu') }}">
                            Prospek
                        </a>
                    </li>

                </ul>
            </div>
        </li>
        <!-- MENU TRANSAKSI DENGAN SUB-MENU -->
<li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#transaksi" aria-expanded="false"
        aria-controls="transaksi">
        <span class="menu-title">Transaksi</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-cash-multiple menu-icon"></i>
    </a>
    <div class="collapse" id="transaksi">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.kpr') }}">Cicilan / KPR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kpr.customer-verified') }}">User verifikasi dokumen kpr</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.kpr.survey') }}">User Acc kpr</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/approved">Approved</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/akad">Akad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/survey">Survey</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/verifikasi-kpr">Vertifikasi KPR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('marketing.cash_pengajuan') }}">Cash Pengajuan</a>
            </li>
        </ul>
    </div>
</li>
        <!-- MENU Dokument -->
        {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('dokument.index')}}">
            <span class="menu-title">Dokument</span>
            <i class="mdi mdi-account-cog menu-icon"></i>
        </a>
    </li> --}}
       <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#dokument" aria-expanded="false"
                aria-controls="dokument">
                <span class="menu-title">Document</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-cog menu-icon"></i>
            </a>
            <div class="collapse" id="dokument">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dokument.index') }}">Tanah Induk (LandBank)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dokument.persiapan') }}">Pecah Tanah Induk Unit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/data-dokument-cash-legal">Data Cash Legal</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#salesAgent" aria-expanded="false"
                aria-controls="salesAgent">

                <span class="menu-title">Sales / Agent</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-tie menu-icon"></i>
            </a>

            <div class="collapse" id="salesAgent">
                <ul class="nav flex-column sub-menu">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('agency.create') }}">
                            Buat Agent / Sales
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('agency.index') }}">
                            Data Agent / Sales
                        </a>
                    </li>

                </ul>
            </div>
        </li>
         <!-- MENU MASTER DATA DENGAN SUB-MENU -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#master-data" aria-expanded="false"
                aria-controls="customer">
                <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-wrench menu-icon"></i>
            </a>
            <div class="collapse" id="master-data">
                <ul class="nav flex-column sub-menu">
                    <!-- MENU Promo -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('promo.index') }}">
                            <span class="menu-title">Promo</span>

                        </a>
                    </li>
                    <!-- MENU Pt -->
                    <li class="nav-item">
                        <a class="nav-link" href="pt">
                            <span class="menu-title">PT</span>

                        </a>
                    </li>

                    <!-- MENU Servis -->
                    <li class="nav-item">
                        <a class="nav-link" href="servis">
                            <span class="menu-title">Servis</span>

                        </a>
                    </li>

                    <!-- MENU Master data bank -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bank.index') }}">
                            <span class="menu-title">Data Bank</span>

                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="rab-deadline">
                            <span class="menu-title">Dedline RAB</span>

                        </a>
                    </li>

                </ul>
            </div>
        </li>

        <!-- MENU LAPORAN -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="menu-title">Laporan</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>

        <!-- MENU PENGATURAN -->
        <li class="nav-item">
            <a class="nav-link" href="pengaturan">
                <span class="menu-title">Pengaturan</span>
                <i class="mdi mdi-cog menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->
