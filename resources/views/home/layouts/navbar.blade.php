<nav class="navbar">
  <div class="nav-inner">
    <a href="{{ route('landingpage') }}" class="nav-logo">
      <img src="{{ asset('images/logo1.png') }}" alt="Logo Graha Cipta Sejahtera" class="nav-logo-img" style="height: 40px; width: auto; object-fit: contain;">
      <span class="nav-logo-text">Graha <span>Cipta Sejahtera</span></span>
    </a>

    <ul class="nav-links">
      <li>
        <a href="{{ route('landingpage') }}" class="{{ request()->routeIs('landingpage') ? 'active' : '' }}">
          <i class="fa-solid fa-house" style="font-size: 0.82rem;"></i> Beranda
        </a>
      </li>

      <li>
        <a href="{{ route('landingpage') }}#simulasi-kpr">
          <i class="fa-solid fa-calculator" style="font-size: 0.82rem;"></i> Simulasi KPR
        </a>
      </li>
      <li>
        <a href="{{ route('landingpage') }}#tentang-kami">
          <i class="fa-solid fa-circle-info" style="font-size: 0.82rem;"></i> Tentang Kami
        </a>
      </li>
    </ul>

    <a href="https://wa.me/62811999988888" target="_blank" class="btn-nav-wa">
      <i class="fa-brands fa-whatsapp" style="font-size: 1.1rem;"></i> Konsultasi Gratis
    </a>

    <button class="hamburger" id="hamburgerBtn" onclick="toggleMenu()" aria-label="Menu Mobile">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

{{-- Backdrop Gelap Saat Mobile Menu Terbuka (Tidak Menggeser Konten) --}}
<div class="mobile-menu-backdrop" id="menuBackdrop" onclick="closeMenu()"></div>

{{-- Mobile Dropdown Menu Floating On Top --}}
<div class="mobile-menu" id="mobileMenu">
  <div class="mobile-menu-header">
    <div class="mobile-menu-brand">
      <img src="{{ asset('images/logo1.png') }}" alt="Logo Graha Cipta Sejahtera" class="nav-logo-img" style="height: 32px; width: auto; object-fit: contain;">
      <div class="mobile-menu-title">Graha <span>Cipta Sejahtera</span></div>
    </div>
    <button class="mobile-menu-close" onclick="closeMenu()" aria-label="Tutup Menu">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>

  <div class="mlabel">Menu</div>
  <a href="{{ route('landingpage') }}" onclick="closeMenu()">
    <i class="fa-solid fa-house"></i> Beranda
  </a>


  <div class="mlabel">Info & Fitur</div>
  <a href="{{ route('landingpage') }}#simulasi-kpr" onclick="closeMenu()">
    <i class="fa-solid fa-calculator"></i> Simulasi KPR
  </a>
  <a href="{{ route('landingpage') }}#tentang-kami" onclick="closeMenu()">
    <i class="fa-solid fa-circle-info"></i> Tentang Kami
  </a>

  <div style="margin-top:1.25rem;">
    <a href="https://wa.me/62811999988888" target="_blank" class="btn-wa">
      <i class="fa-brands fa-whatsapp"></i> Konsultasi Gratis via WhatsApp
    </a>
  </div>
</div>
