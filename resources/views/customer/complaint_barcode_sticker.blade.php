<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Stiker QR Pengaduan - {{ $unit->unit_name ?? 'Unit' }} ({{ $unit->unit_code ?? '-' }})</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Space+Mono:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .no-print-bar {
            background: #ffffff;
            border-radius: 12px;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
        }

        .btn-print {
            background: #4f46e5;
            color: #ffffff;
        }

        .btn-print:hover {
            background: #4338ca;
        }

        .btn-close-tab {
            background: #e2e8f0;
            color: #475569;
        }

        .btn-close-tab:hover {
            background: #cbd5e1;
        }

        /* STICKER CONTAINER */
        .sticker-card {
            width: 380px;
            background: #ffffff;
            border-radius: 20px;
            padding: 28px 24px;
            border: 3px solid #1e293b;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
            position: relative;
        }

        .sticker-header {
            margin-bottom: 16px;
            border-bottom: 2px dashed #cbd5e1;
            padding-bottom: 14px;
        }

        .sticker-tag {
            background: #4f46e5;
            color: #ffffff;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 9999px;
            display: inline-block;
            margin-bottom: 8px;
        }

        .sticker-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.3;
        }

        .sticker-subtitle {
            font-size: 0.78rem;
            color: #64748b;
            margin-top: 2px;
        }

        .qr-wrapper {
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            border-radius: 16px;
            border: 2px solid #e2e8f0;
            margin: 10px 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .qr-wrapper svg {
            width: 180px;
            height: 180px;
            display: block;
        }

        .scan-cta {
            font-size: 0.85rem;
            font-weight: 700;
            color: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-bottom: 14px;
        }

        .unit-details-box {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 14px;
            text-align: left;
            font-size: 0.82rem;
        }

        .unit-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .unit-row:last-child {
            margin-bottom: 0;
        }

        .unit-label {
            color: #64748b;
            font-weight: 500;
        }

        .unit-val {
            color: #0f172a;
            font-weight: 700;
        }

        .unit-code-badge {
            font-family: 'Space Mono', monospace;
            background: #0f172a;
            color: #ffffff;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 0.85rem;
        }

        .sticker-footer {
            margin-top: 14px;
            font-size: 0.68rem;
            color: #94a3b8;
            line-height: 1.4;
        }

        /* PRINT STYLES */
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }

            .no-print-bar {
                display: none !important;
            }

            .sticker-card {
                box-shadow: none;
                border: 2px solid #000000;
                margin: 0 auto;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <!-- Controls (Not printed) -->
    <div class="no-print-bar">
        <span style="font-size: 0.9rem; font-weight: 600; color: #334155;">
            <i class="mdi mdi-printer-outline me-1"></i> Siap Cetak Stiker QR Barcode
        </span>
        <button class="btn-action btn-print" onclick="window.print()">
            <i class="mdi mdi-printer"></i> Cetak Stiker
        </button>
        <button class="btn-action btn-close-tab" onclick="window.close()">
            <i class="mdi mdi-close"></i> Tutup
        </button>
    </div>

    <!-- STIKER FISIK -->
    <div class="sticker-card">
        <div class="sticker-header">
            <span class="sticker-tag">LAYANAN PURNA JUAL</span>
            <h2 class="sticker-title">PENGADUAN & KLAIM GARANSI</h2>
            <p class="sticker-subtitle">Pindai / scan untuk lapor keluhan kerusakan unit</p>
        </div>

        <div class="qr-wrapper">
            @if(!empty($qrCodeSvg))
                {!! $qrCodeSvg !!}
            @else
                <div style="width: 180px; height: 180px; display: flex; align-items: center; justify-content: center; background: #eee; font-size: 0.8rem;">
                    QR Code Gagal Dimuat
                </div>
            @endif
        </div>

        <div class="scan-cta">
            <i class="mdi mdi-camera-iris fs-5"></i> Scan Menggunakan Kamera HP
        </div>

        <div class="unit-details-box">
            <div class="unit-row">
                <span class="unit-label">Perumahan:</span>
                <span class="unit-val">{{ $unit->landBank->name ?? '-' }}</span>
            </div>
            <div class="unit-row">
                <span class="unit-label">Unit / Tipe:</span>
                <span class="unit-val">{{ $unit->unit_name ?? '-' }}</span>
            </div>
            <div class="unit-row">
                <span class="unit-label">Blok & Nomor:</span>
                <span class="unit-val"><span class="unit-code-badge">{{ $unit->unit_code ?? '-' }}</span></span>
            </div>
            <div class="unit-row" style="margin-top: 4px; padding-top: 4px; border-top: 1px dashed #e2e8f0;">
                <span class="unit-label">Pemilik:</span>
                <span class="unit-val">{{ $customer->full_name ?? '-' }}</span>
            </div>
        </div>

        <div class="sticker-footer">
            Tempel stiker ini pada box MCB / folder BAST rumah.<br>
            Layanan pengaduan aktif 24 jam & terhubung ke sistem maintenance.
        </div>
    </div>

</body>
</html>
