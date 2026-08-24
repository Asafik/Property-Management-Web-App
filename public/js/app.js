/**
 * PROPERTY MANAGEMENT - CUSTOM JAVASCRIPT (NAVBAR, SIDEBAR & INTERACTION)
 */

document.addEventListener('DOMContentLoaded', function () {
  const body = document.body;
  const sidebar = document.getElementById('customSidebar');
  const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
  const backdrop = document.getElementById('sidebarBackdrop');
  const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');

  // =========================================================================
  // 1. SIDEBAR TOGGLE HANDLER (DESKTOP & MOBILE)
  // =========================================================================
  if (sidebarToggleBtn) {
    sidebarToggleBtn.addEventListener('click', function (e) {
      e.preventDefault();
      if (window.innerWidth >= 992) {
        // Desktop: Toggle Icon Only mode
        body.classList.toggle('sidebar-icon-only');
        localStorage.setItem('sidebar_icon_only', body.classList.contains('sidebar-icon-only') ? '1' : '0');
      } else {
        // Mobile / Tablet: Toggle Offcanvas
        toggleMobileSidebar();
      }
    });
  }

  // Restore desktop sidebar state from localStorage
  if (window.innerWidth >= 992) {
    if (localStorage.getItem('sidebar_icon_only') === '1') {
      body.classList.add('sidebar-icon-only');
    }
  }

  function toggleMobileSidebar() {
    body.classList.toggle('sidebar-open');
    if (backdrop) {
      backdrop.classList.toggle('show', body.classList.contains('sidebar-open'));
    }
  }

  function closeMobileSidebar() {
    body.classList.remove('sidebar-open');
    if (backdrop) {
      backdrop.classList.remove('show');
    }
  }

  if (backdrop) {
    backdrop.addEventListener('click', closeMobileSidebar);
  }

  if (sidebarCloseBtn) {
    sidebarCloseBtn.addEventListener('click', closeMobileSidebar);
  }

  // =========================================================================
  // 2. SIDEBAR SUB-MENU ACCORDION
  // =========================================================================
  const subMenuToggles = document.querySelectorAll('.has-submenu > .sidebar-menu-link');

  subMenuToggles.forEach(toggle => {
    toggle.addEventListener('click', function (e) {
      e.preventDefault();
      const parentItem = this.closest('.has-submenu');
      const submenu = parentItem.querySelector('.sidebar-submenu');
      const isExpanded = this.getAttribute('aria-expanded') === 'true';

      // If sidebar is minimized in desktop, expand it first
      if (body.classList.contains('sidebar-icon-only') && window.innerWidth >= 992) {
        body.classList.remove('sidebar-icon-only');
        localStorage.setItem('sidebar_icon_only', '0');
      }

      // Close other submenus if accordion behavior desired
      document.querySelectorAll('.has-submenu').forEach(otherItem => {
        if (otherItem !== parentItem) {
          const otherLink = otherItem.querySelector('.sidebar-menu-link');
          const otherSub = otherItem.querySelector('.sidebar-submenu');
          if (otherLink) otherLink.setAttribute('aria-expanded', 'false');
          if (otherSub) otherSub.classList.remove('show');
        }
      });

      // Toggle current submenu
      if (isExpanded) {
        this.setAttribute('aria-expanded', 'false');
        if (submenu) submenu.classList.remove('show');
      } else {
        this.setAttribute('aria-expanded', 'true');
        if (submenu) submenu.classList.add('show');
      }
    });
  });

  // =========================================================================
  // 3. NAVBAR DROPDOWNS (NOTIFICATION & USER PROFILE)
  // =========================================================================
  const dropdownToggles = document.querySelectorAll('[data-custom-toggle="dropdown"]');

  dropdownToggles.forEach(toggle => {
    toggle.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      const targetId = this.getAttribute('data-custom-target');
      const targetDropdown = document.getElementById(targetId);

      // Close other dropdowns
      document.querySelectorAll('.custom-dropdown-menu').forEach(menu => {
        if (menu !== targetDropdown) {
          menu.classList.remove('show');
        }
      });

      if (targetDropdown) {
        targetDropdown.classList.toggle('show');
      }
    });
  });

  // Close dropdowns on outside click
  document.addEventListener('click', function (e) {
    if (!e.target.closest('.custom-dropdown-menu') && !e.target.closest('[data-custom-toggle="dropdown"]')) {
      document.querySelectorAll('.custom-dropdown-menu').forEach(menu => {
        menu.classList.remove('show');
      });
    }
  });

  // =========================================================================
  // 4. FULLSCREEN TOGGLE
  // =========================================================================
  const fullscreenBtn = document.getElementById('customFullscreenBtn');
  if (fullscreenBtn) {
    fullscreenBtn.addEventListener('click', function (e) {
      e.preventDefault();
      if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(err => {
          console.warn(`Error attempting fullscreen: ${err.message}`);
        });
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        }
      }
    });
  }

  // =========================================================================
  // 5. GLOBAL SELECT2 INITIALIZATION (NO SEARCH BOX BY DEFAULT, SEARCH ON .select2-search)
  // =========================================================================
  function initGlobalSelect2() {
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
      jQuery('select').not('.no-select2, .select2-hidden-accessible, [multiple]').each(function () {
        const $this = jQuery(this);
        const modalParent = $this.closest('.modal');
        const enableSearch = $this.hasClass('select2-search') || $this.data('search') === true || $this.data('search') === 'true';

        const config = {
          theme: 'bootstrap-5',
          width: $this.data('width') || '100%',
          dropdownParent: modalParent.length ? modalParent : jQuery(document.body)
        };

        if (!enableSearch) {
          config.minimumResultsForSearch = Infinity;
        }

        $this.select2(config);
      });
    }
  }

  // Initialize on page load
  initGlobalSelect2();

  // Re-initialize when Bootstrap modals open
  if (typeof jQuery !== 'undefined') {
    jQuery(document).on('shown.bs.modal', function () {
      initGlobalSelect2();
    });
  }
});

