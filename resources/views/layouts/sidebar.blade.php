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

        <!-- DASHBOARD - HANYA AKTIF SAAT DI DASHBOARD -->
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-view-dashboard menu-icon"></i>
            </a>
        </li>

        <!-- MENU MARKETING DENGAN SUB-MENU -->
        @php
            $marketingActive = request()->routeIs('marketing.jual-unit') || request()->routeIs('marketing.list_pengajuan');
        @endphp
        <li class="nav-item {{ $marketingActive ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#marketing" aria-expanded="{{ $marketingActive ? 'true' : 'false' }}" aria-controls="marketing">
                <span class="menu-title">Marketing</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-bullhorn menu-icon"></i>
            </a>
            <div class="collapse {{ $marketingActive ? 'show' : '' }}" id="marketing">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('marketing.jual-unit') ? 'active' : '' }}" href="{{ route('marketing.jual-unit') }}">
                            Jual Unit
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('marketing.list_pengajuan') ? 'active' : '' }}" href="{{ route('marketing.list_pengajuan') }}">
                            Customer Booking
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- MENU PROPERTI DENGAN SUB-MENU -->
        @php
            $propertiActive = request()->routeIs('properti-all') || request()->routeIs('properti') || request()->routeIs('kavling.index') || request()->routeIs('lokasi.index');
        @endphp
        <li class="nav-item {{ $propertiActive ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#properti" aria-expanded="{{ $propertiActive ? 'true' : 'false' }}" aria-controls="properti">
                <span class="menu-title">Tanah Induk (Land Bank)</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-office-building menu-icon"></i>
            </a>
            <div class="collapse {{ $propertiActive ? 'show' : '' }}" id="properti">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('properti-all') ? 'active' : '' }}" href="{{ route('properti-all') }}">
                            Semua Tanah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('properti') ? 'active' : '' }}" href="{{ route('properti') }}">
                            Tambah Tanah (LandBank)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kavling.index') ? 'active' : '' }}" href="{{ route('kavling.index') }}">
                            Tambah Kavling
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lokasi.index') ? 'active' : '' }}" href="{{ route('lokasi.index') }}">
                            Lokasi
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- MENU CUSTOMER DENGAN SUB-MENU -->
        @php
            $customerActive = request()->routeIs('customer.tambah_customer') || request()->routeIs('customer.data') || request()->routeIs('customer.tamu');
        @endphp
        <li class="nav-item {{ $customerActive ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#customer" aria-expanded="{{ $customerActive ? 'true' : 'false' }}" aria-controls="customer">
                <span class="menu-title">Customer</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-group menu-icon"></i>
            </a>
            <div class="collapse {{ $customerActive ? 'show' : '' }}" id="customer">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.tambah_customer') ? 'active' : '' }}" href="{{ route('customer.tambah_customer') }}">
                            Tambah Customer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.data') ? 'active' : '' }}" href="{{ route('customer.data') }}">
                            Customer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.tamu') ? 'active' : '' }}" href="{{ route('customer.tamu') }}">
                            Tamu / Prospek
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- MENU TRANSAKSI DENGAN SUB-MENU -->
        @php
            $transaksiActive = request()->routeIs('customer.kpr') ||
                               request()->routeIs('kpr.customer-verified') ||
                               request()->routeIs('customer.kpr.survey') ||
                               request()->routeIs('marketing.cash_pengajuan');
        @endphp
        <li class="nav-item {{ $transaksiActive ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#transaksi" aria-expanded="{{ $transaksiActive ? 'true' : 'false' }}" aria-controls="transaksi">
                <span class="menu-title">Transaksi</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cash-multiple menu-icon"></i>
            </a>
            <div class="collapse {{ $transaksiActive ? 'show' : '' }}" id="transaksi">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.kpr') ? 'active' : '' }}" href="{{ route('customer.kpr') }}">
                            Cicilan / KPR
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kpr.customer-verified') ? 'active' : '' }}" href="{{ route('kpr.customer-verified') }}">
                            Customer Verifikasi Dokumen KPR
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.kpr.survey') ? 'active' : '' }}" href="{{ route('customer.kpr.survey') }}">
                            Customer Acc KPR
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard-approved">
                            Approved
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard-akad">
                            Akad
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard-survey">
                            Survey
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard-vertifikasi-kpr">
                            Verifikasi KPR
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('marketing.cash_pengajuan') ? 'active' : '' }}" href="{{ route('marketing.cash_pengajuan') }}">
                            Cash Pengajuan
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- MENU DOKUMENT -->
        @php
            $dokumentActive = request()->routeIs('dokument.index') || request()->routeIs('dokument.persiapan');
        @endphp
        <li class="nav-item {{ $dokumentActive ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#dokument" aria-expanded="{{ $dokumentActive ? 'true' : 'false' }}" aria-controls="dokument">
                <span class="menu-title">Document</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-file-document-box menu-icon"></i>
            </a>
            <div class="collapse {{ $dokumentActive ? 'show' : '' }}" id="dokument">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dokument.index') ? 'active' : '' }}" href="{{ route('dokument.index') }}">
                            Document Tanah Induk (LandBank)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dokument.persiapan') ? 'active' : '' }}" href="{{ route('dokument.persiapan') }}">
                            Document Pecah Tanah Induk ke Unit
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard-data-dokument-cash-legal">
                            Data Dokument Cash Legal
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- MENU SALES / AGENT -->
        @php
            $salesActive = request()->routeIs('agency.create') || request()->routeIs('agency.index');
        @endphp
        <li class="nav-item {{ $salesActive ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#salesAgent" aria-expanded="{{ $salesActive ? 'true' : 'false' }}" aria-controls="salesAgent">
                <span class="menu-title">Sales / Agent</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-tie menu-icon"></i>
            </a>
            <div class="collapse {{ $salesActive ? 'show' : '' }}" id="salesAgent">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('agency.create') ? 'active' : '' }}" href="{{ route('agency.create') }}">
                            Buat Agent / Sales
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('agency.index') ? 'active' : '' }}" href="{{ route('agency.index') }}">
                            Data Agent / Sales
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- MENU MASTER DATA DENGAN SUB-MENU -->
        @php
            $masterDataActive = request()->routeIs('promo.index') || request()->routeIs('bank.index');
        @endphp
        <li class="nav-item {{ $masterDataActive ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#master-data" aria-expanded="{{ $masterDataActive ? 'true' : 'false' }}" aria-controls="master-data">
                <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-database menu-icon"></i>
            </a>
            <div class="collapse {{ $masterDataActive ? 'show' : '' }}" id="master-data">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('promo.index') ? 'active' : '' }}" href="{{ route('promo.index') }}">
                            Promo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard-pt">
                            PT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard-servis">
                            Servis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('bank.index') ? 'active' : '' }}" href="{{ route('bank.index') }}">
                            Data Bank
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard-dedline-rab">
                            Deadline RAB
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
            <a class="nav-link" href="dashboard-pengaturan">
                <span class="menu-title">Pengaturan</span>
                <i class="mdi mdi-cog menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->
