<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Properti Management</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Icons dari Purple Admin -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">

    <!-- Google Fonts Nunito (seperti Purple Admin) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #f8f9fc;
        }

        .register-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 3rem 2rem;
            border-radius: 20px 0 0 20px;
            min-height: 700px;
        }

        .register-right {
            background: white;
            padding: 3rem 2rem;
            border-radius: 0 20px 20px 0;
            min-height: 700px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .illustration {
            max-width: 300px;
            margin-bottom: 2rem;
        }

        .illustration i {
            font-size: 120px;
            color: rgba(255, 255, 255, 0.2);
            margin-bottom: 1rem;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0 0;
            text-align: left;
            width: 100%;
            max-width: 300px;
        }

        .feature-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feature-list li i {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.2);
            padding: 5px;
            border-radius: 50%;
        }

        @media (max-width: 991px) {
            .register-left {
                border-radius: 20px 20px 0 0;
                min-height: auto;
                padding: 2rem;
            }

            .register-right {
                border-radius: 0 0 20px 20px;
                min-height: auto;
            }

            .illustration i {
                font-size: 80px;
            }
        }
    </style>
</head>
<body>

<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11 col-xl-10">
            <!-- Card Utama -->
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="row g-0">

                    <!-- KIRI: Ilustrasi & Info (sama dengan halaman login) -->
                    <div class="col-lg-5 register-left">
                        <div class="illustration">
                            <i class="mdi mdi-account-plus"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Bergabung Sekarang!</h3>
                        <p class="mb-4 px-3">Daftar sebagai sales/agent untuk mulai mengelola properti dan mendapatkan komisi penjualan.</p>

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
                    <div class="col-lg-7 register-right">

                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h2 class="fw-bold" style="color: #2c2e3f;">Daftar Akun Baru</h2>
                            <p class="text-muted">Isi data Anda untuk mendaftar sebagai sales/agent</p>
                        </div>

                        <!-- Form Register -->
                        <form action="#" method="POST">

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small text-uppercase">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                                        <i class="mdi mdi-account text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control bg-light border-start-0 ps-0"
                                           placeholder="Masukkan nama lengkap"
                                           style="border-radius: 0 10px 10px 0;">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small text-uppercase">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                                        <i class="mdi mdi-email text-muted"></i>
                                    </span>
                                    <input type="email" class="form-control bg-light border-start-0 ps-0"
                                           placeholder="Masukkan email"
                                           style="border-radius: 0 10px 10px 0;">
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small text-uppercase">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                                        <i class="mdi mdi-account-circle text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control bg-light border-start-0 ps-0"
                                           placeholder="Masukkan username"
                                           style="border-radius: 0 10px 10px 0;">
                                </div>
                            </div>

                            <!-- Nomor HP -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small text-uppercase">Nomor HP</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                                        <i class="mdi mdi-phone text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control bg-light border-start-0 ps-0"
                                           placeholder="Masukkan nomor HP"
                                           style="border-radius: 0 10px 10px 0;">
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small text-uppercase">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                                        <i class="mdi mdi-lock text-muted"></i>
                                    </span>
                                    <input type="password" class="form-control bg-light border-start-0 ps-0"
                                           placeholder="Masukkan password"
                                           style="border-radius: 0 10px 10px 0;">
                                    <span class="input-group-text bg-light border-start-0" style="border-radius: 0 10px 10px 0;">
                                        <i class="mdi mdi-eye text-muted"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small text-uppercase">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                                        <i class="mdi mdi-lock-check text-muted"></i>
                                    </span>
                                    <input type="password" class="form-control bg-light border-start-0 ps-0"
                                           placeholder="Ulangi password"
                                           style="border-radius: 0 10px 10px 0;">
                                    <span class="input-group-text bg-light border-start-0" style="border-radius: 0 10px 10px 0;">
                                        <i class="mdi mdi-eye text-muted"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small text-uppercase">Alamat</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                                        <i class="mdi mdi-map-marker text-muted"></i>
                                    </span>
                                    <textarea class="form-control bg-light border-start-0 ps-0"
                                              rows="2"
                                              placeholder="Masukkan alamat lengkap"
                                              style="border-radius: 0 10px 10px 0;"></textarea>
                                </div>
                            </div>

                            <!-- Role (hidden) -->
                            <input type="hidden" name="role" value="agency">

                            <!-- Terms & Conditions -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" checked>
                                    <label class="form-check-label small text-muted" for="terms">
                                        Saya setuju dengan <a href="#" class="text-decoration-none" style="color: #9a55ff;">Syarat & Ketentuan</a> dan <a href="#" class="text-decoration-none" style="color: #9a55ff;">Kebijakan Privasi</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Button Register -->
                            <button type="submit" class="btn btn-lg w-100 text-white fw-semibold py-3 mb-3"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 10px;">
                                <i class="mdi mdi-account-plus me-2"></i>
                                Daftar Sekarang
                            </button>

                            <!-- Divider -->
                            <div class="d-flex align-items-center mb-3">
                                <hr class="flex-grow-1">
                                <span class="mx-3 text-muted small">atau daftar dengan</span>
                                <hr class="flex-grow-1">
                            </div>

                            <!-- Social Register -->
                            <div class="d-flex justify-content-center gap-3 mb-3">
                                <a href="#" class="btn btn-outline-secondary rounded-circle p-3 d-flex align-items-center justify-content-center"
                                   style="width: 50px; height: 50px;">
                                    <i class="mdi mdi-google"></i>
                                </a>
                                <a href="#" class="btn btn-outline-secondary rounded-circle p-3 d-flex align-items-center justify-content-center"
                                   style="width: 50px; height: 50px;">
                                    <i class="mdi mdi-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-outline-secondary rounded-circle p-3 d-flex align-items-center justify-content-center"
                                   style="width: 50px; height: 50px;">
                                    <i class="mdi mdi-twitter"></i>
                                </a>
                            </div>

                        </form>

                        <!-- Footer -->
                        <div class="text-center mt-3">
                            <p class="small text-muted mb-0">Sudah punya akun? <a href="#" class="text-decoration-none" style="color: #9a55ff;">Login di sini</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
