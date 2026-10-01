<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pengaduan Berhasil Dikirim - {{ $ticket }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --primary-light: #eef2ff;
            --success: #10b981;
            --dark: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            padding: 30px 16px 60px;
        }

        .success-container {
            max-width: 580px;
            margin: 0 auto;
        }

        .success-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            border: 1px solid #e2e8f0;
            padding: 36px 24px;
            text-align: center;
        }

        .check-circle {
            width: 80px;
            height: 80px;
            background: #ecfdf5;
            border: 3px solid #10b981;
            color: #10b981;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            margin-bottom: 20px;
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);
            animation: popIn 0.5s ease-out forwards;
        }

        @keyframes popIn {
            0% { transform: scale(0.6); opacity: 0; }
            80% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }

        .ticket-badge {
            background: #f1f5f9;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 12px 18px;
            display: inline-block;
            margin: 15px 0 20px;
        }

        .ticket-number {
            font-family: monospace;
            font-size: 1.35rem;
            font-weight: 800;
            color: #4f46e5;
            letter-spacing: 1px;
        }

        .step-timeline {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 25px 0;
            padding: 0 10px;
        }

        .step-timeline::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 20px;
            right: 20px;
            height: 3px;
            background: #e2e8f0;
            z-index: 1;
        }

        .step-item {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }

        .step-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #cbd5e1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 6px;
        }

        .step-active .step-dot {
            background: #10b981;
            border-color: #10b981;
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
        }

        .step-text {
            font-size: 0.72rem;
            font-weight: 700;
            color: #64748b;
            display: block;
        }

        .step-active .step-text {
            color: #0f172a;
        }

        .summary-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px;
            text-align: left;
            margin-bottom: 24px;
        }

        .btn-wa {
            background: #25d366;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            font-size: 0.95rem;
            box-shadow: 0 4px 6px -1px rgba(37, 211, 102, 0.3);
            text-decoration: none;
            margin-bottom: 10px;
        }

        .btn-wa:hover {
            background: #20bd5a;
            color: #ffffff;
        }

        .btn-back {
            background: #ffffff;
            border: 1.5px solid #cbd5e1;
            color: #475569;
            font-weight: 600;
            padding: 11px 20px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #f1f5f9;
            color: #1e293b;
        }
    </style>
</head>
<body>

    <div class="success-container">
        <div class="success-card">
            <!-- Icon Checkmark -->
            <div class="check-circle">
                <i class="mdi mdi-check"></i>
            </div>

            <h4 class="fw-bold text-dark mb-1">Pengaduan Berhasil Dikirim!</h4>
            <p class="text-muted small mb-0">Laporan keluhan Anda telah masuk ke dalam antrean tim after-sales & maintenance properti.</p>

            <!-- Ticket Badge -->
            <div class="ticket-badge">
                <small class="text-muted d-block fw-semibold" style="font-size: 0.75rem;">NOMOR TIKET PENGADUAN:</small>
                <div class="ticket-number">{{ $ticket }}</div>
                @if(session('allTickets') && count(session('allTickets')) > 1)
                    <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                        {{ count(session('allTickets')) }} keluhan diajukan: 
                        <strong>{{ implode(', ', session('allTickets')) }}</strong>
                    </small>
                @endif
            </div>

            <!-- Steps / Alur Penanganan -->
            <div class="step-timeline">
                <div class="step-item step-active">
                    <div class="step-dot"><i class="mdi mdi-check"></i></div>
                    <span class="step-text">Diterima</span>
                </div>
                <div class="step-item">
                    <div class="step-dot">2</div>
                    <span class="step-text">Verifikasi</span>
                </div>
                <div class="step-item">
                    <div class="step-dot">3</div>
                    <span class="step-text">Survei / SPK</span>
                </div>
                <div class="step-item">
                    <div class="step-dot">4</div>
                    <span class="step-text">Perbaikan</span>
                </div>
            </div>

            <!-- Unit Info -->
            <div class="summary-box">
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <span class="small text-muted">Perumahan:</span>
                    <strong class="text-dark small">{{ $booking->unit->landBank->name ?? '-' }}</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <span class="small text-muted">Unit / Blok:</span>
                    <strong class="text-dark small font-monospace">{{ $booking->unit->unit_name ?? '-' }} (Blok {{ $booking->unit->unit_code ?? '-' }})</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <span class="small text-muted">Pemilik:</span>
                    <strong class="text-dark small">{{ $booking->customer->full_name ?? '-' }}</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted">Waktu Lapor:</span>
                    <span class="text-dark small">{{ now()->format('d M Y - H:i') }} WIB</span>
                </div>
            </div>

            <!-- Tindak Lanjut -->
            <div class="alert alert-light border text-start p-3 mb-4 rounded-3" style="font-size: 0.82rem; background: #fafafa;">
                <div class="fw-bold text-dark mb-1 d-flex align-items-center gap-1">
                    <i class="mdi mdi-clock-check-outline text-primary"></i> Apa langkah selanjutnya?
                </div>
                <p class="mb-0 text-muted" style="line-height: 1.5;">
                    Pengawas proyek akan menghubungi nomor WhatsApp Anda untuk menjadwalkan kunjungan teknisi. Harap pastikan nomor aktif dan dapat dihubungi.
                </p>
            </div>

            <!-- WA Hotline -->
            @php
                $waText = urlencode("Halo Tim Maintenance, saya telah mengajukan pengaduan untuk Unit " . ($booking->unit->unit_name ?? '') . " Blok " . ($booking->unit->unit_code ?? '') . " dengan No. Tiket: " . $ticket . ". Mohon dibantu tindak lanjutnya. Terima kasih.");
            @endphp
            <a href="https://wa.me/?text={{ $waText }}" target="_blank" class="btn-wa">
                <i class="mdi mdi-whatsapp fs-5"></i> Konfirmasi ke WhatsApp Tim Maintenance
            </a>

            <!-- Kembali Form -->
            <a href="{{ route('complaint.customer.form', $booking->booking_code ?: $booking->id) }}" class="btn-back">
                <i class="mdi mdi-arrow-left"></i> Kembali ke Form Pengaduan Unit
            </a>
        </div>
    </div>

</body>
</html>
