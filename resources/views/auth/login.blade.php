<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Properti Management</title>

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

        .login-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 3rem 2rem;
            border-radius: 20px 0 0 20px;
            min-height: 600px;
        }

        .login-right {
            background: white;
            padding: 3rem 2rem;
            border-radius: 0 20px 20px 0;
            min-height: 600px;
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
            .login-left {
                border-radius: 20px 20px 0 0;
                min-height: auto;
                padding: 2rem;
            }

            .login-right {
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

                    <!-- KIRI: Ilustrasi & Info -->
                    <div class="col-lg-5 login-left">
                        <div class="illustration">
                            <i class="mdi mdi-home-city"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Selamat Datang!</h3>
                        <p class="mb-4 px-3">Sistem Manajemen Properti Terintegrasi untuk mengelola tanah, kavling, dan penjualan dengan mudah.</p>

                        <ul class="feature-list">
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Kelola data tanah & properti</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Buat kavling & master unit</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Verifikasi dokumen legal</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Pantau progress pembangunan</span>
                            </li>
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                <span>Laporan RAB & keuangan</span>
                            </li>
                        </ul>

                        <div class="mt-4 text-white-50 small">
                            <i class="mdi mdi-shield-check me-1"></i>
                            Aman & Terpercaya
                        </div>
                    </div>

                    <!-- KANAN: Form Login -->
                    <div class="col-lg-7 login-right">

                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h2 class="fw-bold" style="color: #2c2e3f;">Masuk ke Akun</h2>
                            <p class="text-muted">Silakan login untuk mengakses dashboard</p>
                        </div>

                        <!-- Alert Demo -->
                        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                            <i class="mdi mdi-information-outline me-2 fs-5"></i>
                            <div>Demo: admin@example.com | admin123</div>
                        </div>

                        <!-- Form Login -->
                       <form action="{{ route('login.proses') }}" method="POST">
@csrf

<!-- USERNAME -->
<div class="mb-4">
    <label class="form-label fw-semibold text-muted small text-uppercase">Username</label>
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0">
            <i class="mdi mdi-account text-muted"></i>
        </span>
        <input type="text" name="username" class="form-control bg-light border-start-0 ps-0"
               placeholder="Masukkan username"
               required>
    </div>
</div>

<!-- PASSWORD -->
<div class="mb-4">
    <label class="form-label fw-semibold text-muted small text-uppercase">Password</label>
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0">
            <i class="mdi mdi-lock text-muted"></i>
        </span>
        <input type="password" name="password" class="form-control bg-light border-start-0 ps-0"
               placeholder="Masukkan password"
               required>
    </div>
</div>

<button type="submit" class="btn btn-lg w-100 text-white fw-semibold py-3 mb-4"
        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border:none;">
    <i class="mdi mdi-login me-2"></i> Login
</button>

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

</form>


                        <!-- Footer -->
                        <div class="text-center mt-4">
                            <p class="small text-muted mb-0">Belum punya akun? <a href="#" class="text-decoration-none" style="color: #9a55ff;">Hubungi Admin</a></p>
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
