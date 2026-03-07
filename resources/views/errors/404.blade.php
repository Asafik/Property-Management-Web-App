<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Properti Management</title>

    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #f0f2f5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Card styling sama dengan halaman sebelumnya */
        .error-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(154, 85, 255, 0.1);
            padding: 3rem;
            max-width: 600px;
            width: 100%;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(154, 85, 255, 0.1);
        }

        .error-card:hover {
            box-shadow: 0 15px 50px rgba(154, 85, 255, 0.2);
            transform: translateY(-5px);
        }

        /* Icon styling */
        .error-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            border: 3px solid rgba(154, 85, 255, 0.2);
        }

        .error-icon i {
            font-size: 60px;
            color: #9a55ff;
        }

        /* Angka 404 */
        .error-number {
            font-size: 8rem;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            text-shadow: 0 5px 15px rgba(154, 85, 255, 0.3);
        }

        @media (max-width: 576px) {
            .error-number {
                font-size: 6rem;
            }
        }

        /* Judul error */
        .error-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 1rem;
        }

        @media (max-width: 576px) {
            .error-title {
                font-size: 1.5rem;
            }
        }

        /* Pesan error */
        .error-message {
            color: #6c7383;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Button styling - sama dengan halaman sebelumnya */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: white;
            box-shadow: 0 4px 15px rgba(154, 85, 255, 0.3);
        }

        .btn-gradient-primary:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.4);
        }

        .btn-gradient-secondary {
            background: linear-gradient(135deg, #f0f2f5, #e4e6ea);
            color: #2c2e3f;
            border: 1px solid #e9ecef;
        }

        .btn-gradient-secondary:hover {
            background: linear-gradient(135deg, #e4e6ea, #d8dce2);
            color: #2c2e3f;
        }

        /* Icon dalam button */
        .btn i {
            font-size: 1.1rem;
        }

        /* Action buttons container */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        /* Info tambahan */
        .info-text {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: #a5b3cb;
            font-size: 0.85rem;
            margin-top: 2rem;
        }

        .info-text i {
            color: #9a55ff;
            font-size: 1rem;
        }

        /* Animasi fade in */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Responsive untuk mobile */
        @media (max-width: 576px) {
            .error-card {
                padding: 2rem 1.5rem;
            }

            .error-icon {
                width: 100px;
                height: 100px;
            }

            .error-icon i {
                font-size: 50px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.75rem;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="error-card">
        <!-- Icon 404 dengan background gradient -->
        <div class="error-icon">
            <i class="mdi mdi-file-search-outline"></i>
        </div>

        <!-- Angka 404 dengan gradient -->
        <div class="error-number">404</div>

        <!-- Judul error -->
        <h1 class="error-title">Halaman Tidak Ditemukan</h1>

        <!-- Pesan error -->
        <p class="error-message">
            Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.
            Silakan periksa kembali URL atau kembali ke halaman utama.
        </p>

        <!-- Action buttons -->
        <div class="action-buttons">
            <a href="/dashboard" class="btn btn-gradient-primary">
                <i class="mdi mdi-view-dashboard"></i>
                Ke Dashboard
            </a>
            <a href="javascript:history.back()" class="btn btn-gradient-secondary">
                <i class="mdi mdi-arrow-left"></i>
                Kembali
            </a>
        </div>

        <!-- Info tambahan -->
        <div class="info-text">
            <i class="mdi mdi-information-outline"></i>
            <span>Jika masalah berlanjut, hubungi tim support</span>
        </div>

        <!-- Copyright -->
        <div style="margin-top: 2rem; color: #a5b3cb; font-size: 0.75rem;">
            &copy; 2024 Properti Management. All rights reserved.
        </div>
    </div>
</body>
</html>
