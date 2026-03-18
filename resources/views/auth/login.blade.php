@extends('home.layouts.partials.app')

@section('title', 'Login — Sweet Home')

@push('styles')
<style>
  html, body {
    min-height: 100vh;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  main {
    width: 100%;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1.25rem;
  }

  .login-card {
    width: 100%;
    max-width: 960px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 32px 80px rgba(11,31,75,0.18);
  }

  /* LEFT */
  .login-left {
    position: relative;
    background-image: url('https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=900&h=1200&fit=crop');
    background-size: cover;
    background-position: center;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 2.5rem 2rem;
    min-height: 580px;
  }

  .login-left-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(160deg,
      rgba(11,31,75,0.55) 0%,
      rgba(60,20,120,0.45) 40%,
      rgba(11,31,75,0.92) 100%
    );
  }

  .login-left-content { position: relative; z-index: 1; }

  .left-logo {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    position: absolute;
    top: 2.5rem;
    left: 2rem;
    z-index: 1;
    text-decoration: none;
  }
  .left-logo-icon {
    width: 38px; height: 38px;
    background: var(--gold);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
  }
  .left-logo-icon i { color: white; font-size: 1rem; }
  .left-logo-text { font-family: 'DM Serif Display', serif; font-size: 1.3rem; color: white; }
  .left-logo-text span { color: var(--gold-light); }

  .left-title {
    font-family: 'DM Serif Display', serif;
    font-size: clamp(1.5rem, 2.5vw, 2rem);
    color: white;
    line-height: 1.2;
    margin-bottom: 0.75rem;
  }
  .left-title em { color: var(--gold-light); font-style: italic; }

  .left-sub {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.6);
    line-height: 1.6;
    margin-bottom: 1.5rem;
  }

  .left-features { display: flex; flex-direction: column; gap: 0.55rem; }
  .left-feat {
    display: flex; align-items: center; gap: 0.6rem;
    font-size: 0.82rem; color: rgba(255,255,255,0.85); font-weight: 500;
  }
  .left-feat i { color: var(--gold-light); font-size: 0.72rem; flex-shrink: 0; }

  /* RIGHT */
  .login-right {
    background: white;
    padding: 3rem 2.5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .login-right-head { margin-bottom: 2rem; }
  .login-right-head h2 {
    font-family: 'DM Serif Display', serif;
    font-size: 1.85rem;
    color: var(--navy);
    margin-bottom: 0.35rem;
  }
  .login-right-head p { font-size: 0.875rem; color: var(--text-light); }

  /* ACCENT BAR */
  .accent-bar {
    display: flex;
    gap: 0.35rem;
    margin-bottom: 2rem;
  }
  .accent-bar span { height: 4px; border-radius: 100px; }
  .accent-bar .bar-navy   { width: 32px; background: var(--navy); }
  .accent-bar .bar-purple { width: 20px; background: #7C3AED; }
  .accent-bar .bar-gold   { width: 12px; background: var(--gold); }

  /* FORM */
  .form-group { margin-bottom: 1.25rem; }

  .form-label-custom {
    display: block;
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--gold);
    margin-bottom: 0.4rem;
  }

  .input-wrap {
    display: flex;
    align-items: center;
    background: var(--cream);
    border: 1.5px solid var(--border);
    border-radius: 12px;
    transition: all 0.2s;
    overflow: hidden;
  }
  .input-wrap:focus-within {
    border-color: #7C3AED;
    background: white;
    box-shadow: 0 0 0 3px rgba(124,58,237,0.08);
  }

  .input-icon {
    width: 44px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .input-icon i { color: #7C3AED; font-size: 0.9rem; }

  .input-wrap input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 0.8rem 0.75rem 0.8rem 0;
    font-size: 0.9rem;
    color: var(--text-dark);
    font-family: 'DM Sans', sans-serif;
    outline: none;
    min-width: 0;
  }
  .input-wrap input::placeholder { color: var(--text-light); }

  .toggle-pass {
    width: 44px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; flex-shrink: 0;
  }
  .toggle-pass i { color: var(--text-light); font-size: 0.9rem; transition: color 0.2s; }
  .toggle-pass:hover i { color: #7C3AED; }

  /* REMEMBER */
  .remember-row {
    display: flex; align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 0.5rem;
  }
  .remember-check {
    display: flex; align-items: center;
    gap: 0.5rem; cursor: pointer;
  }
  .remember-check input[type="checkbox"] {
    width: 16px; height: 16px;
    border-radius: 4px;
    accent-color: #7C3AED;
    cursor: pointer;
  }
  .remember-check span { font-size: 0.875rem; color: var(--text-mid); font-weight: 500; }

  .forgot-link {
    font-size: 0.875rem; color: var(--text-light);
    text-decoration: none; font-weight: 500;
    transition: color 0.2s;
  }
  .forgot-link:hover { color: #7C3AED; }

  /* BTN */
  .btn-login {
    width: 100%;
    padding: 0.9rem;
    background: var(--navy);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 700;
    font-family: 'DM Sans', sans-serif;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    gap: 0.5rem;
    transition: all 0.2s;
  }
  .btn-login:hover {
    background: var(--navy-mid);
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(11,31,75,0.25);
  }

  /* FOOTER */
  .login-footer {
    text-align: center;
    margin-top: 1.75rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
    font-size: 0.78rem;
    color: var(--text-light);
  }
  .login-footer a { color: var(--text-light); text-decoration: none; }
  .login-footer a:hover { color: var(--navy); }

  /* RESPONSIVE */
  @media (max-width: 900px) {
    .login-card {
      grid-template-columns: 1fr;
      max-width: 520px;
      border-radius: 22px;
    }
    .login-left {
      min-height: 240px;
      padding: 1.75rem;
      justify-content: flex-end;
    }
    .left-logo { top: 1.75rem; left: 1.75rem; }
    .left-features { display: none; }
    .left-sub { display: none; }
    .left-title { font-size: 1.4rem; margin-bottom: 0; }
    .login-right { padding: 2rem 2rem; }
  }

  @media (max-width: 480px) {
    main { padding: 1rem; }
    .login-card { border-radius: 18px; }
    .login-left { min-height: 180px; padding: 1.25rem; }
    .left-logo { top: 1.25rem; left: 1.25rem; }
    .left-title { font-size: 1.2rem; }
    .login-right { padding: 1.5rem 1.25rem; }
    .login-right-head h2 { font-size: 1.5rem; }
    .remember-row { flex-direction: column; align-items: flex-start; }
  }
</style>
@endpush

@section('content')
<div class="login-card">

  {{-- LEFT --}}
  <div class="login-left">
    <div class="login-left-overlay"></div>

    <a href="#" class="left-logo">
      <div class="left-logo-icon"><i class="fa-solid fa-house-chimney"></i></div>
      <span class="left-logo-text">Sweet <span>Home</span></span>
    </a>

    <div class="login-left-content">
      <h2 class="left-title">Kelola properti<br><em>lebih mudah</em></h2>
      <p class="left-sub">Sistem manajemen properti terintegrasi untuk developer rumah subsidi, komersil, dan cash/KPR.</p>
      <div class="left-features">
        <div class="left-feat"><i class="fa-solid fa-circle-check"></i> Manajemen Tanah & Properti</div>
        <div class="left-feat"><i class="fa-solid fa-circle-check"></i> Pembuatan Kavling Otomatis</div>
        <div class="left-feat"><i class="fa-solid fa-circle-check"></i> Verifikasi Dokumen Legal</div>
        <div class="left-feat"><i class="fa-solid fa-circle-check"></i> Progress Pembangunan</div>
        <div class="left-feat"><i class="fa-solid fa-circle-check"></i> Laporan RAB & Keuangan</div>
      </div>
    </div>
  </div>

  {{-- RIGHT --}}
  <div class="login-right">

    <div class="login-right-head">
      <h2>Masuk ke Akun</h2>
      <p>Silakan login untuk mengakses dashboard</p>
    </div>

    <div class="accent-bar">
      <span class="bar-navy"></span>
      <span class="bar-purple"></span>
      <span class="bar-gold"></span>
    </div>

    <form action="{{ route('login.proses') }}" method="POST" id="loginForm">
      @csrf

      <div class="form-group">
        <label class="form-label-custom">Username</label>
        <div class="input-wrap">
          <div class="input-icon"><i class="fa-solid fa-user"></i></div>
          <input type="text" name="username" placeholder="Masukkan username Anda" value="{{ old('username') }}" required>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label-custom">Password</label>
        <div class="input-wrap">
          <div class="input-icon"><i class="fa-solid fa-lock"></i></div>
          <input type="password" name="password" id="password" placeholder="Masukkan password Anda" required>
          <div class="toggle-pass" onclick="togglePassword()">
            <i class="fa-regular fa-eye" id="password-icon"></i>
          </div>
        </div>
      </div>

      <div class="remember-row">
        <label class="remember-check">
          <input type="checkbox" name="remember" id="remember">
          <span>Ingat saya</span>
        </label>
        <a href="#" class="forgot-link">Lupa password?</a>
      </div>

      <button type="submit" class="btn-login" id="loginBtn">
        <i class="fa-solid fa-right-to-bracket"></i> Login ke Dashboard
      </button>

    </form>

    <div class="login-footer">
      <div>&copy; {{ date('Y') }} Sweet Home — Properti Management</div>
      <div style="margin-top:0.4rem;">
        <i class="fa-solid fa-shield-halved" style="color:#7C3AED; font-size:0.7rem;"></i>
        Enterprise Grade Security
      </div>
    </div>

  </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function togglePassword() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('password-icon');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
  }

  document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;

    Swal.fire({
      title: 'Memproses Login...',
      text: 'Mohon tunggu sebentar',
      allowOutsideClick: false,
      allowEscapeKey: false,
      showConfirmButton: false,
      didOpen: () => Swal.showLoading()
    });

    setTimeout(() => form.submit(), 400);
  });

  @if(session('error'))
    Swal.fire({
      icon: 'error',
      title: 'Login Gagal',
      text: '{{ session('error') }}',
      confirmButtonColor: '#0B1F4B',
      confirmButtonText: 'Coba Lagi',
      borderRadius: '16px'
    });
  @endif
</script>
@endpush
