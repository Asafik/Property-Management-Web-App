<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Sweet Home — Jual Rumah')</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  @stack('styles')
</head>
<body>
  <div id="scroll-progress"></div>

  <main>
    @yield('content')
  </main>

  <script>
    function toggleMenu() {
      const menu = document.getElementById('mobileMenu');
      const backdrop = document.getElementById('menuBackdrop');
      if (menu && backdrop) {
        if (menu.classList.contains('open')) {
          closeMenu();
        } else {
          openMenu();
        }
      }
    }

    function openMenu() {
      const menu = document.getElementById('mobileMenu');
      const backdrop = document.getElementById('menuBackdrop');
      if (menu && backdrop) {
        menu.classList.add('open');
        backdrop.classList.add('open');
        document.body.style.overflow = 'hidden';
      }
    }

    function closeMenu() {
      const menu = document.getElementById('mobileMenu');
      const backdrop = document.getElementById('menuBackdrop');
      if (menu && backdrop) {
        menu.classList.remove('open');
        backdrop.classList.remove('open');
        document.body.style.overflow = '';
      }
    }
  </script>
  @stack('scripts')
</body>
</html>
