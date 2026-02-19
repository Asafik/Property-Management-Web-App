<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Properti Management</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">

    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* Background Pattern Sederhana */
        .bg-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image:
                radial-gradient(circle at 30% 40%, rgba(154, 85, 255, 0.03) 0%, transparent 30%),
                radial-gradient(circle at 70% 60%, rgba(102, 126, 234, 0.03) 0%, transparent 40%);
        }

        /* Card Utama */
        .login-card {
            background: white;
            border: 1px solid rgba(154, 85, 255, 0.1);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
            border-radius: 32px;
            overflow: hidden;
        }

        /* Left Panel - Gradient Solid */
        .login-left {
            background: linear-gradient(145deg, #667eea, #9a55ff, #da8cff);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 3rem 2rem;
            min-height: 700px;
        }

        /* Illustration */
        .illustration-icon {
            font-size: 120px;
            color: rgba(255, 255, 255, 0.2);
            margin-bottom: 1.5rem;
        }

        /* Feature List */
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0 0;
            text-align: left;
            width: 100%;
            max-width: 320px;
        }

        .feature-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.75rem 1rem;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .feature-list li i {
            font-size: 24px;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            padding: 6px;
            border-radius: 12px;
        }

        /* Right Panel */
        .login-right {
            background: white;
            padding: 3.5rem 3rem;
            min-height: 700px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-badge {
            position: absolute;
            top: 20px;
            right: 30px;
            background: #f8f4ff;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-size: 0.8rem;
            color: #9a55ff;
            border: 1px solid rgba(154, 85, 255, 0.2);
            font-weight: 600;
        }

        /* Form Styling - Clean & Simple */
        .form-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: #9a55ff;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .input-group {
            border-radius: 16px;
            border: 2px solid transparent;
            background: #f8fafd;
        }

        .input-group:focus-within {
            border-color: #9a55ff;
            background: white;
        }

        .input-group-text {
            border: none;
            background: transparent;
            padding-left: 1.2rem;
        }

        .input-group-text:first-child {
            border-radius: 16px 0 0 16px !important;
        }

        .password-toggle {
            border-radius: 0 16px 16px 0 !important;
            cursor: pointer;
            background: transparent !important;
        }

        .password-toggle i {
            font-size: 1.3rem;
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .password-toggle:hover i {
            color: #9a55ff;
        }

        .input-group-text i {
            font-size: 1.3rem;
            color: #9a55ff;
        }

        .form-control {
            border: none;
            background: transparent;
            padding: 0.9rem 1rem 0.9rem 0.5rem;
            font-size: 0.95rem;
            color: #1e293b;
        }

        .form-control:focus {
            background: transparent;
            box-shadow: none;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        /* Checkbox */
        .form-check-input {
            width: 18px;
            height: 18px;
            border-radius: 5px;
            border: 2px solid #e2e8f0;
        }

        .form-check-input:checked {
            background-color: #9a55ff;
            border-color: #9a55ff;
        }

        .form-check-label {
            color: #475569;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Forgot Password */
        .forgot-link {
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .forgot-link:hover {
            color: #9a55ff;
        }

        /* Login Button */
        .btn-login {
            background: linear-gradient(135deg, #667eea, #9a55ff);
            border: none;
            border-radius: 16px;
            padding: 1rem;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 8px 16px -4px rgba(102, 126, 234, 0.2);
        }

        .btn-login:hover {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 12px 20px -8px rgba(102, 126, 234, 0.3);
        }

        /* Alert */
        .alert-modern {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            border-radius: 16px;
            padding: 1rem 1.2rem;
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-modern i {
            color: #ef4444;
            font-size: 1.3rem;
        }

        /* Footer */
        .footer-link {
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .footer-link:hover {
            color: #9a55ff;
        }

        /* Loading State */
        .btn-loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-loading::after {
            content: '';
            display: inline-block;
            width: 16px;
            height: 16px;
            margin-left: 8px;
            border: 2px solid white;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 991px) {
            .login-left {
                min-height: auto;
                padding: 2rem;
            }

            .login-right {
                min-height: auto;
                padding: 2.5rem 2rem;
            }

            .illustration-icon {
                font-size: 80px;
            }

            .brand-badge {
                position: relative;
                top: auto;
                right: auto;
                display: inline-block;
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .login-right {
                padding: 2rem 1.5rem;
            }

            .feature-list {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<!-- Background Pattern Sederhana -->
<div class="bg-pattern"></div>

<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xl-10">
            <!-- Card Utama -->
            <div class="login-card">
                <div class="row g-0">

                    <!-- KIRI: Gradient Solid -->
                    <div class="col-lg-5 login-left">
                        <div class="illustration">
                            <i class="mdi mdi-home-city illustration-icon"></i>
                        </div>

                        <h3 class="fw-bold mb-3">Welcome Back!</h3>
                        <p class="mb-4 px-3">
                            Kelola properti Anda dengan sistem terintegrasi
                        </p>

                        <ul class="feature-list">
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Manajemen Tanah & Properti</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Pembuatan Kavling Otomatis</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Verifikasi Dokumen Legal</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Progress Pembangunan</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Laporan RAB & Keuangan</span>
                            </li>
                        </ul>

                        <div class="mt-4 text-white-50 small">
                            <i class="mdi mdi-shield-check me-1"></i>
                            Enterprise Grade Security
                        </div>
                    </div>

                    <!-- KANAN: Form Login -->
                    <div class="col-lg-7 login-right position-relative">

                        <div class="brand-badge">
                            <i class="mdi mdi-crown"></i>
                            Properti Management
                        </div>

                        <!-- Header Form -->
                        <div class="text-center mb-5">
                            <h2 class="fw-bold mb-2" style="color: #1e293b;">Masuk ke Akun</h2>
                            <p class="text-muted">Silakan login untuk mengakses dashboard</p>
                        </div>

                        <!-- Form Login -->
                        <form action="{{ route('login.proses') }}" method="POST">
                            @csrf

                            <!-- USERNAME -->
                            <div class="mb-4">
                                <label class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-account"></i>
                                    </span>
                                    <input type="text" name="username" class="form-control"
                                           placeholder="Masukkan username Anda"
                                           value="{{ old('username') }}"
                                           required>
                                </div>
                            </div>

                            <!-- PASSWORD dengan toggle -->
                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="Masukkan password Anda"
                                           required>
                                    <span class="input-group-text password-toggle" onclick="togglePassword()">
                                        <i class="mdi mdi-eye" id="password-icon"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Remember & Forgot -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">
                                        Ingat saya
                                    </label>
                                </div>
                                <a href="#" class="forgot-link">
                                    Lupa password?
                                </a>
                            </div>

                            <!-- Button Login -->
                            <button type="submit" class="btn-login" id="loginBtn">
                                <i class="mdi mdi-login"></i>
                                Login ke Dashboard
                            </button>

                            @if(session('error'))
                            <div class="alert-modern" role="alert">
                                <i class="mdi mdi-alert-circle"></i>
                                <div>{{ session('error') }}</div>
                            </div>
                            @endif

                        </form>

                        <!-- Footer -->
                        <div class="text-center mt-5">
                            <p class="small text-muted mb-3">
                                <a href="#" class="footer-link">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali ke Beranda
                                </a>
                            </p>
                            <div class="d-flex justify-content-center gap-3">
                                <span class="text-muted small">© 2024 Properti Management</span>
                                <span class="text-muted small">|</span>
                                <span class="text-muted small">All rights reserved</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Toggle Password Visibility
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const passwordIcon = document.getElementById('password-icon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.classList.remove('mdi-eye');
            passwordIcon.classList.add('mdi-eye-off');
        } else {
            passwordField.type = 'password';
            passwordIcon.classList.remove('mdi-eye-off');
            passwordIcon.classList.add('mdi-eye');
        }
    }

    // Loading animation on form submit
    document.querySelector('form')?.addEventListener('submit', function(e) {
        const btn = document.getElementById('loginBtn');
        btn.classList.add('btn-loading');
        btn.innerHTML = '<i class="mdi mdi-login"></i> Memproses...';
    });
</script>

</body>
</html>
