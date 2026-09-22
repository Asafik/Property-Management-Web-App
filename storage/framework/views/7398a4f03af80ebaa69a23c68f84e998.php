<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title', 'Sweet Home — Jual Rumah'); ?></title>
  <link rel="icon" type="image/jpeg" href="<?php echo e(asset('images/logo.jpeg')); ?>">
  <link rel="shortcut icon" href="<?php echo e(asset('images/logo.jpeg')); ?>">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('css/home.css')); ?>">
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
  <div id="scroll-progress"></div>

  <main>
    <?php echo $__env->yieldContent('content'); ?>
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
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Property-Management-Web-App\resources\views/home/layouts/partials/app.blade.php ENDPATH**/ ?>