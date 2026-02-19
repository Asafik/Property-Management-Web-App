<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Properti Management</title>

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
        .register-card {
            background: white;
            border: 1px solid rgba(154, 85, 255, 0.1);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
            border-radius: 32px;
            overflow: hidden;
        }

        /* Left Panel - Gradient Solid */
        .register-left {
            background: linear-gradient(145deg, #667eea, #9a55ff, #da8cff);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 3rem 2rem;
            min-height: 800px;
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
        .register-right {
            background: white;
            padding: 3rem 3rem;
            min-height: 800px;
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

        /* Form Styling */
        .form-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: #9a55ff;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.4rem;
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
            border-radius: 16px 0 0 16px !important;
            padding-left: 1.2rem;
        }

        .input-group-text i {
            font-size: 1.2rem;
            color: #9a55ff;
        }

        .form-control, .form-select, textarea.form-control {
            border: none;
            background: transparent;
            border-radius: 0 16px 16px 0 !important;
            padding: 0.75rem 1rem 0.75rem 0.5rem;
            font-size: 0.95rem;
            color: #1e293b;
        }

        textarea.form-control {
            min-height: 80px;
            resize: vertical;
        }

        .form-control:focus, .form-select:focus, textarea.form-control:focus {
            background: transparent;
            box-shadow: none;
        }

        .form-control::placeholder, textarea.form-control::placeholder {
            color: #94a3b8;
        }

        /* Password toggle */
        .password-toggle {
            cursor: pointer;
            border-radius: 0 16px 16px 0 !important;
            background: transparent !important;
        }

        .password-toggle i {
            font-size: 1.2rem;
            color: #94a3b8;
        }

        .password-toggle:hover i {
            color: #9a55ff;
        }

        /* Checkbox */
        .form-check-input {
            width: 18px;
            height: 18px;
            border-radius: 5px;
            border: 2px solid #e2e8f0;
            margin-top: 0;
        }

        .form-check-input:checked {
            background-color: #9a55ff;
            border-color: #9a55ff;
        }

        .form-check-label {
            color: #475569;
            font-size: 0.85rem;
        }

        .form-check-label a {
            color: #9a55ff;
            text-decoration: none;
            font-weight: 600;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        /* Register Button */
        .btn-register {
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
            transition: all 0.2s ease;
        }

        .btn-register:hover {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 12px 20px -8px rgba(102, 126, 234, 0.3);
        }

        /* Social Login */
        .social-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 1px solid #e2e8f0;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.2s ease;
        }

        .social-btn:hover {
            background: #f8f4ff;
            border-color: #9a55ff;
            color: #9a55ff;
        }

        .social-btn i {
            font-size: 1.3rem;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            color: #94a3b8;
            font-size: 0.8rem;
            margin: 1.5rem 0;
        }

        .divider-line {
            flex-grow: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider-text {
            margin: 0 1rem;
        }

        /* Footer Link */
        .footer-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .footer-link:hover {
            color: #9a55ff;
        }

        .login-link {
            color: #9a55ff;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .register-left {
                min-height: auto;
                padding: 2rem;
            }

            .register-right {
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
            .register-right {
                padding: 2rem 1.5rem;
            }

            .feature-list {
                max-width: 100%;
            }

            .social-btn {
                width: 44px;
                height: 44px;
            }
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
    </style>
</head>
<body>

<!-- Background Pattern Sederhana -->
<div class="bg-pattern"></div>

<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xl-10">
            <!-- Card Utama -->
            <div class="register-card">
                <div class="row g-0">

                    <!-- KIRI: Gradient Solid -->
                    <div class="col-lg-5 register-left">
                        <div class="illustration">
                            <i class="mdi mdi-account-plus illustration-icon"></i>
                        </div>

                        <h3 class="fw-bold mb-3">Bergabung Sekarang!</h3>
                        <p class="mb-4 px-3">
                            Daftar sebagai sales/agent untuk mulai mengelola properti dan mendapatkan komisi penjualan.
                        </p>

                        <ul class="feature-list">
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Akses ke semua fitur</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Kelola unit penjualan</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Pantau komisi real-time</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Laporan penjualan</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Dukungan 24/7</span>
                            </li>
                        </ul>

                        <div class="mt-4 text-white-50 small">
                            <i class="mdi mdi-shield-check me-1"></i>
                            Data aman & terenkripsi
                        </div>
                    </div>

                    <!-- KANAN: Form Register -->
                    <div class="col-lg-7 register-right position-relative">

                        <div class="brand-badge">
                            <i class="mdi mdi-crown"></i>
                            Properti Management
                        </div>

                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-2 mt-5" style="color: #1e293b;">Daftar Akun Baru</h2>
                            <p class="text-muted">Isi data Anda untuk mendaftar sebagai sales/agent</p>
                        </div>

                        <!-- Form Register -->
                        <form id="registerForm" action="#" method="POST">

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-account"></i>
                                    </span>
                                    <input type="text" class="form-control"
                                           placeholder="Masukkan nama lengkap"
                                           required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-email"></i>
                                    </span>
                                    <input type="email" class="form-control"
                                           placeholder="Masukkan email"
                                           required>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-account-circle"></i>
                                    </span>
                                    <input type="text" class="form-control"
                                           placeholder="Masukkan username"
                                           required>
                                </div>
                            </div>

                            <!-- Nomor HP -->
                            <div class="mb-3">
                                <label class="form-label">Nomor HP</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-phone"></i>
                                    </span>
                                    <input type="tel" class="form-control"
                                           placeholder="Masukkan nomor HP"
                                           required>
                                </div>
                            </div>

                            <!-- Password dengan toggle -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password"
                                           placeholder="Masukkan password"
                                           required>
                                    <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                                        <i class="mdi mdi-eye" id="password-icon"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Konfirmasi Password dengan toggle -->
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-lock-check"></i>
                                    </span>
                                    <input type="password" class="form-control" id="confirm-password"
                                           placeholder="Ulangi password"
                                           required>
                                    <span class="input-group-text password-toggle" onclick="togglePassword('confirm-password')">
                                        <i class="mdi mdi-eye" id="confirm-password-icon"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-map-marker"></i>
                                    </span>
                                    <textarea class="form-control"
                                              rows="2"
                                              placeholder="Masukkan alamat lengkap"></textarea>
                                </div>
                            </div>

                            <!-- Role (hidden) -->
                            <input type="hidden" name="role" value="agency">

                            <!-- Terms & Conditions -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" checked>
                                    <label class="form-check-label" for="terms">
                                        Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Button Register -->
                            <button type="submit" class="btn-register" id="registerBtn">
                                <i class="mdi mdi-account-plus"></i>
                                Daftar Sekarang
                            </button>

                            <!-- Divider -->
                            <div class="divider">
                                <div class="divider-line"></div>
                                <span class="divider-text">atau daftar dengan</span>
                                <div class="divider-line"></div>
                            </div>

                            <!-- Social Register -->
                            <div class="d-flex justify-content-center gap-3 mb-3">
                                <a href="#" class="social-btn">
                                    <i class="mdi mdi-google"></i>
                                </a>
                                <a href="#" class="social-btn">
                                    <i class="mdi mdi-facebook"></i>
                                </a>
                                <a href="#" class="social-btn">
                                    <i class="mdi mdi-twitter"></i>
                                </a>
                            </div>

                        </form>

                        <!-- Footer -->
                        <div class="text-center mt-3">
                            <p class="small text-muted mb-0">
                                Sudah punya akun?
                                <a href="#" class="login-link">Login di sini</a>
                            </p>
                            <p class="small text-muted mt-2">
                                <a href="#" class="footer-link">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali ke Beranda
                                </a>
                            </p>
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
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '-icon');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('mdi-eye');
            icon.classList.add('mdi-eye-off');
        } else {
            field.type = 'password';
            icon.classList.remove('mdi-eye-off');
            icon.classList.add('mdi-eye');
        }
    }

    // Loading animation on form submit
    document.getElementById('registerForm')?.addEventListener('submit', function(e) {
        const btn = document.getElementById('registerBtn');
        btn.classList.add('btn-loading');
        btn.innerHTML = '<i class="mdi mdi-account-plus"></i> Mendaftar...';
    });

    // Simple password match validation
    document.getElementById('registerForm')?.addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Password dan konfirmasi password tidak cocok!');

            // Reset button
            const btn = document.getElementById('registerBtn');
            btn.classList.remove('btn-loading');
            btn.innerHTML = '<i class="mdi mdi-account-plus"></i> Daftar Sekarang';
        }
    });
</script>

</body>
</html>
