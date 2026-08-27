<nav class="navbar">
  <div class="nav-inner">
    <a href="{{ route('landingpage') }}" class="nav-logo">
      <div class="nav-logo-icon">
        <i class="fa-solid fa-house-chimney"></i>
      </div>
      <span class="nav-logo-text">Sweet <span>Home</span></span>
    </a>

    <ul class="nav-links">
      <li>
        <a href="{{ route('landingpage') }}" class="active">
          <i class="fa-solid fa-house" style="font-size: 0.82rem;"></i> Beranda
        </a>
      </li>
      <li>
        <a href="#simulasi-kpr">
          <i class="fa-solid fa-calculator" style="font-size: 0.82rem;"></i> Simulasi KPR
        </a>
      </li>
      <li>
        <a href="#tentang-kami">
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
      <div class="nav-logo-icon" style="width: 30px; height: 30px; font-size: 0.9rem;">
        <i class="fa-solid fa-house-chimney"></i>
      </div>
      <div class="mobile-menu-title">Sweet <span>Home</span></div>
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
  <a href="#simulasi-kpr" onclick="closeMenu()">
    <i class="fa-solid fa-calculator"></i> Simulasi KPR
  </a>
  <a href="#tentang-kami" onclick="closeMenu()">
    <i class="fa-solid fa-circle-info"></i> Tentang Kami
  </a>

  <div style="margin-top:1.25rem;">
    <a href="https://wa.me/62811999988888" target="_blank" class="btn-wa">
      <i class="fa-brands fa-whatsapp"></i> Konsultasi Gratis via WhatsApp
    </a>
  </div>
</div>
