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

    <!-- MENU SIDEBAR - PROPERTI REAL ESTATE -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    <!-- MENU PROPERTI DENGAN SUB-MENU -->
    <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#properti" aria-expanded="false" aria-controls="properti">
        <span class="menu-title">Properti</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-office-building menu-icon"></i>
    </a>
    <div class="collapse" id="properti">
        <ul class="nav flex-column sub-menu">
        <li class="nav-item">
            <a class="nav-link" href="#">Semua Properti</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard-tambah-properti">Tambah Properti</a>
        </li>
        <!-- TAMBAHAN MENU BARU SESUAI FLOWCHART -->
        <li class="nav-item">
            <a class="nav-link" href="#">Verifikasi Legal</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Buat Kavling</a>
        </li>
        <!-- END TAMBAHAN MENU -->
        <li class="nav-item">
            <a class="nav-link" href="#">Kategori</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Lokasi</a>
        </li>
        </ul>
    </div>
    </li>

    <!-- MENU CUSTOMER -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="menu-title">Customer</span>
        <i class="mdi mdi-account-group menu-icon"></i>
      </a>
    </li>

    <!-- MENU TRANSAKSI DENGAN SUB-MENU -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#transaksi" aria-expanded="false" aria-controls="transaksi">
        <span class="menu-title">Transaksi</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-cash-multiple menu-icon"></i>
      </a>
      <div class="collapse" id="transaksi">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="#">Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Penjualan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Cicilan / KPR</a>
          </li>
        </ul>
      </div>
    </li>

    <!-- MENU INVENTORY UNIT -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="menu-title">Inventory Unit</span>
        <i class="mdi mdi-package-variant menu-icon"></i>
      </a>
    </li>

    <!-- MENU SALES / AGENT -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="menu-title">Sales / Agent</span>
        <i class="mdi mdi-account-tie menu-icon"></i>
      </a>
    </li>

    <!-- MENU LAPORAN -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="menu-title">Laporan</span>
        <i class="mdi mdi-chart-bar menu-icon"></i>
      </a>
    </li>

    <!-- MENU USER MANAGEMENT -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="menu-title">User Management</span>
        <i class="mdi mdi-account-cog menu-icon"></i>
      </a>
    </li>

    <!-- MENU PENGATURAN -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="menu-title">Pengaturan</span>
        <i class="mdi mdi-cog menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- partial -->
