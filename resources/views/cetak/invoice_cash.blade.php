<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice Cash Keras - Properti Management</title>

    @if(!isset($pdf) || !$pdf)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.9.55/css/materialdesignicons.min.css">
    @endif

    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif !important;
            background-color: {{ isset($pdf) && $pdf ? 'white' : '#f5f7fa' }};
            padding: {{ isset($pdf) && $pdf ? '0' : '30px 20px' }};
            margin: {{ isset($pdf) && $pdf ? '2cm' : '0' }};
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }

        /* Paksa semua pakai Times New Roman */
        body, .card, .card-body, table, td, th, p, h1, h2, h3, h4, h5,
        .btn, .badge-status, .info-section, .terbilang, .footer-note,
        .alert, small, strong, span, div {
            font-family: 'Times New Roman', Times, serif !important;
        }

        .invoice-container {
            max-width: 210mm;
            width: 100%;
            margin: 0 auto;
            position: relative;
            box-shadow: {{ isset($pdf) && $pdf ? 'none' : '0 8px 20px rgba(0,0,0,0.1)' }};
        }

        /* ===== WATERMARK ===== */
        .watermark-text {
            user-select: none;
            font-size: 70px;
            color: rgba(75, 73, 172, 0.15);
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            white-space: nowrap;
            z-index: 999;
            pointer-events: none;
            font-weight: bold;
            border: 4px double rgba(75, 73, 172, 0.1);
            padding: 20px 50px;
            border-radius: 10px;
            letter-spacing: 6px;
        }

        @if(!isset($pdf) || !$pdf)
        .watermark-pattern {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 998;
            opacity: 0.08;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            transform: rotate(-20deg);
        }

        .watermark-pattern span {
            font-size: 50px;
            font-weight: bold;
            color: #4b49ac;
            margin: 40px;
            white-space: nowrap;
        }
        @endif

        /* ===== TOMBOL ===== */
        @if(!isset($pdf) || !$pdf)
        .btn-container {
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: 0.2s;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4b49ac, #7a78c5);
            color: white;
        }

        .btn-success {
            background: linear-gradient(45deg, #00d25b, #028a44);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(45deg, #ffab2e, #f16a0e);
            color: white;
        }

        .btn-outline-secondary {
            border: 1px solid #6c757d;
            color: #6c757d;
            background: white;
        }

        .btn.active {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            border: 2px solid #4b49ac;
            font-weight: bold;
        }

        .btn:hover {
            opacity: 0.9;
        }
        @endif

        /* ===== CARD ===== */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: {{ isset($pdf) && $pdf ? 'none' : '0 2px 15px rgba(0, 0, 0, 0.1)' }};
            margin-bottom: {{ isset($pdf) && $pdf ? '0' : '25px' }};
            position: relative;
            z-index: 1;
            border: {{ isset($pdf) && $pdf ? 'none' : '1px solid #e0e5ec' }};
        }

        .card-body {
            padding: 40px 45px;
        }

        /* ===== HEADER ===== */
        .invoice-header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #4b49ac;
            padding-bottom: 20px;
        }

        .invoice-header h2 {
            color: #4b49ac;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .invoice-header p {
            color: #6c757d;
            margin: 2px 0;
            font-size: 14px;
        }

        .invoice-title {
            text-align: center;
            margin: 20px 0 25px;
        }

        .invoice-title h3 {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px dashed #4b49ac;
            padding-bottom: 8px;
            display: inline-block;
        }

        /* ===== FLEX ROW ===== */
        .row-flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .col-half {
            width: 48%;
        }

        /* ===== TABEL INFO ===== */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            line-height: 1.5;
        }

        .info-table td {
            padding: 6px 5px;
            border: none;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 130px;
            font-weight: 600;
            color: #555;
        }

        .info-table td:nth-child(2) {
            width: 15px;
            text-align: center;
        }

        /* ===== INFO SECTION ===== */
        .info-section {
            margin-bottom: 30px;
            padding: 18px 22px;
            background-color: #f8f9fc;
            border-left: 6px solid #4b49ac;
            border-radius: 0 8px 8px 0;
        }

        .info-section h5, h5 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #4b49ac;
            text-decoration: underline;
            text-underline-offset: 5px;
        }

        /* ===== TABEL DETAIL ===== */
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0 15px;
            font-size: 15px;
        }

        .detail-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .detail-table tr:last-child td {
            border-bottom: none;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .grand-total {
            background-color: #4b49ac;
            color: white;
            font-weight: bold;
        }

        .grand-total td {
            font-size: 16px;
            padding: 12px 10px;
        }

        .text-end {
            text-align: right;
        }

        .text-success {
            color: #00d25b;
        }

        /* ===== TERBILANG ===== */
        .terbilang {
            margin: 20px 0;
            padding: 15px 20px;
            background-color: #f8f9fc;
            border-left: 6px solid #4b49ac;
            font-style: italic;
            font-size: 16px;
            border-radius: 0 8px 8px 0;
        }

        /* ===== ALERT ===== */
        .alert-warning {
            background-color: #fff3cd;
            border: 1px solid #ffab2e;
            padding: 16px;
            border-radius: 8px;
            margin: 20px 0;
        }

        /* ===== BADGE ===== */
        .badge-status {
            display: inline-block;
            padding: 5px 18px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .badge-success {
            background-color: #00d25b;
            color: white;
        }

        .badge-warning {
            background-color: #ffab2e;
            color: white;
        }

        /* ===== METODE PEMBAYARAN ===== */
        .payment-method {
            margin: 25px 0 30px;
            padding: 18px 22px;
            border: 1px dashed #4b49ac;
            background: white;
            border-radius: 8px;
        }

        /* ===== FOOTER ===== */
        .footer-note {
            margin-top: 35px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px dashed #acb8c5;
            padding-top: 18px;
        }

        /* ===== QR CODE ===== */
        .qr-container {
            text-align: right;
            margin-top: 15px;
        }

        .qr-box {
            display: inline-block;
            text-align: center;
        }

        .qr-box svg {
            width: 90px;
            height: 90px;
        }

        .qr-text {
            font-size: 9px;
            margin-top: 4px;
            color: #4b49ac;
        }

        .d-none {
            display: none;
        }

        /* ===== PRINT ===== */
        @media print {
            @page {
                size: A4;
                margin: 1.8cm;
            }

            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .invoice-container {
                max-width: 100%;
                box-shadow: none;
            }

            .btn-container,
            .d-print-none,
            .watermark-pattern {
                display: none !important;
            }

            .card {
                border: none;
                box-shadow: none;
            }

            .card-body {
                padding: 0;
            }

            .watermark-text {
                opacity: 0.15;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .badge-success, .grand-total, .badge-warning {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <!-- WATERMARK -->
    <div class="watermark-text">PT PROPERTI MANAGEMENT</div>

    @if(!isset($pdf) || !$pdf)
    <div class="watermark-pattern">
        <span>PT PROPERTI MANAGEMENT</span><span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span><span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span><span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span><span>PT PROPERTI MANAGEMENT</span>
    </div>
    @endif

    <div class="invoice-container">
        @if(!isset($pdf) || !$pdf)
        <!-- TOMBOL WEB -->
        <div class="btn-container d-print-none">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <div>
                    <button class="btn btn-outline-secondary" onclick="history.back()">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </button>
                </div>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ $downloadUrlCash }}" class="btn btn-success" target="_blank">
                        <i class="mdi mdi-download"></i> PDF Cash Awal
                    </a>
                    <a href="{{ $downloadUrlKonversi }}" class="btn btn-warning" target="_blank">
                        <i class="mdi mdi-download"></i> PDF Konversi
                    </a>
                    <button class="btn btn-primary" onclick="window.print()">
                        <i class="mdi mdi-printer"></i> Cetak
                    </button>
                </div>
            </div>
            <div style="display: flex; justify-content: center; margin-bottom: 10px;">
                <div class="btn-group" style="display: flex; gap: 6px;">
                    <button type="button" class="btn btn-success active" id="btnCashAwal">
                        <i class="mdi mdi-cash"></i> Cash Awal
                    </button>
                    <button type="button" class="btn btn-warning" id="btnKonversi">
                        <i class="mdi mdi-bank-off"></i> Konversi dari KPR
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- CARD INVOICE -->
        <div class="card">
            <div class="card-body">
                <!-- HEADER PERUSAHAAN -->
                <div class="invoice-header">
                    <h2>PT PROPERTI MANAGEMENT</h2>
                    <p>Jl. Sudirman No. 123, Jakarta Selatan 12190</p>
                    <p>Telp: (021) 1234567 | Email: info@propertimanagement.com</p>
                    <p>NPWP: 01.234.567.8-123.000</p>
                </div>

                <!-- JUDUL INVOICE -->
                <div class="invoice-title">
                    <h3 id="invoiceTitle">
                        @if(isset($jenis) && $jenis == 'konversi')
                            INVOICE CASH KERAS (KONVERSI DARI KPR)
                        @else
                            INVOICE CASH KERAS (LUNAS LANGSUNG)
                        @endif
                    </h3>
                </div>

                <!-- INFO INVOICE -->
                @php
                    $pelunasan = $booking->payments->where('type', 'pelunasan')->first();
                    $totalPaid = $booking->payments->sum('amount');
                    $hargaFinal = ($booking->harga_nego ?? $booking->unit->price);

                    if (isset($jenis) && $jenis == 'konversi') {
                        $status = 'LUNAS (Konversi)';
                        $badgeClass = 'badge-warning';
                    } else {
                        $status = $totalPaid >= $hargaFinal ? 'LUNAS' : 'BELUM LUNAS';
                        $badgeClass = $status == 'LUNAS' ? 'badge-success' : 'badge-warning';
                    }
                @endphp

                <table class="info-table" style="width:100%; margin-bottom:20px;">
                    <tr>
                        <td>No. Invoice</td>
                        <td>:</td>
                        <td><strong id="invoiceNumber">{{ $invoiceNumber }}</strong></td>
                    </tr>
                    <tr>
                        <td>Tanggal Invoice</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($booking->invoice_date ?? $booking->created_at)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lunas</td>
                        <td>:</td>
                        <td>{{ $pelunasan ? \Carbon\Carbon::parse($pelunasan->payment_date)->translatedFormat('d F Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <span class="badge-status {{ $badgeClass }}" id="statusBadge">{{ $status }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Cash</td>
                        <td>:</td>
                        <td id="jenisCash">
                            @if(isset($jenis) && $jenis == 'konversi')
                                Cash Keras (Konversi dari KPR)
                            @else
                                {{ $booking->type_cash ?? 'Cash Keras (Lunas Langsung)' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Metode</td>
                        <td>:</td>
                        <td>{{ $pelunasan->method ?? '-' }}</td>
                    </tr>
                </table>

                <!-- DATA CUSTOMER -->
                <div class="info-section">
                    <h5>DATA CUSTOMER</h5>
                    <table class="info-table">
                        <tr><td>Nama Customer</td><td>:</td><td><strong>{{ $booking->customer->full_name ?? 'Ahmad Amrozi' }}</strong></td></tr>
                        <tr><td>NIK</td><td>:</td><td>{{ $booking->customer->nik ?? '3273011203850001' }}</td></tr>
                        <tr><td>No. HP</td><td>:</td><td>{{ $booking->customer->phone ?? '081234567890' }}</td></tr>
                        <tr><td>Booking ID</td><td>:</td><td>{{ $booking->booking_code ?? '#INV/202502/001' }}</td></tr>
                        <tr><td>Unit</td><td>:</td><td>{{ $booking->unit->type ?? 'The Lavender - Tipe 45' }}</td></tr>
                        <tr><td>Blok/No</td><td>:</td><td>{{ $booking->unit->unit_code ?? 'C/12' }}</td></tr>
                    </table>
                </div>

                <!-- RINCIAN HARGA -->
                <h5>RINCIAN HARGA</h5>
                <table class="detail-table">
                    <tr>
                        <td width="60%"><strong>Harga Unit</strong></td>
                        <td class="text-end">{{ $booking->unit->price ? 'Rp ' . number_format($booking->unit->price, 0, ',', '.') : 'Rp 450.000.000' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Hasil Negosiasi / Diskon</strong></td>
                        <td class="text-end text-success">- {{ $booking->harga_nego ? 'Rp ' . number_format($booking->harga_nego, 0, ',', '.') : 'Rp 20.000.000' }}</td>
                    </tr>
                    <tr class="total-row">
                        <td><strong>Harga Final Kesepakatan</strong></td>
                        <td class="text-end"><strong>Rp {{ number_format(($booking->unit->price ?? 450000000) - ($booking->harga_nego ?? 20000000), 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr class="grand-total">
                        <td><strong>TOTAL PEMBAYARAN LUNAS</strong></td>
                        <td class="text-end"><strong>Rp {{ number_format(($booking->unit->price ?? 450000000) - ($booking->harga_nego ?? 20000000), 0, ',', '.') }}</strong></td>
                    </tr>
                </table>

                <!-- TERBILANG -->
                <div class="terbilang">
                    <strong>Terbilang:</strong> {{ $terbilang ?? 'Empat ratus tiga puluh juta rupiah' }}
                </div>

                <!-- INFORMASI KHUSUS KONVERSI -->
                <div id="infoKonversi" class="{{ (!isset($jenis) || $jenis != 'konversi') ? 'd-none' : '' }}">
                    <div class="alert-warning">
                        <i class="mdi mdi-information-outline me-2"></i>
                        <strong>Catatan:</strong> Pembayaran ini merupakan konversi dari KPR yang ditolak.<br>
                        <small>Biaya KPR hangus: Rp 4.100.000 (Biaya Survey + Biaya Provisi) - sudah termasuk dalam perhitungan</small>
                    </div>
                </div>

                <!-- METODE PEMBAYARAN -->
                <div class="payment-method">
                    <h5>METODE PEMBAYARAN</h5>
                    <table class="info-table">
                        <tr><td>Metode</td><td>:</td><td>{{ $pelunasan->method ?? 'Transfer Bank' }}</td></tr>
                        <tr><td>Nama Bank</td><td>:</td><td>{{ $pelunasan->banks->bank_name ?? 'Bank Mandiri' }}</td></tr>
                        <tr><td>No. Rekening</td><td>:</td><td>{{ $pelunasan->banks->number ?? '123-456-7890' }}</td></tr>
                        <tr><td>Atas Nama</td><td>:</td><td>{{ $pelunasan->banks->account_holder ?? 'PT Properti Management' }}</td></tr>
                        <tr><td>Tanggal Transfer</td><td>:</td><td>{{ $pelunasan ? \Carbon\Carbon::parse($pelunasan->payment_date)->translatedFormat('d F Y') : '-' }}</td></tr>
                        <tr><td>Catatan</td><td>:</td><td>{{ $pelunasan->notes ?? '-' }}</td></tr>
                    </table>
                </div>

                <!-- TANDA TANGAN -->
                <table style="width: 100%; margin-top: 55px; border-collapse: collapse; page-break-inside: avoid;">
                    <tr>
                        <td style="width: 45%; text-align: center; vertical-align: top; padding: 0;">
                            <p style="margin: 0 0 5px 0; font-weight: 500; font-size: 14px; text-align: center;">Penerima,</p>
                            <div style="margin-top: 50px; border-top: 2px solid #000000; padding-top: 10px; font-weight: 600; font-size: 16px; text-align: center; width: 100%;">
                                {{ $booking->sales->name ?? '_________________' }}
                            </div>
                            <p style="color: #6c757d; font-size: 12px; margin-top: 5px; text-align: center;">{{ $booking->sales->role ?? 'Finance Manager' }}</p>
                        </td>

                        <td style="width: 10%;"></td>

                        <td style="width: 45%; text-align: center; vertical-align: top; padding: 0;">
                            <p style="margin: 0 0 5px 0; font-weight: 500; font-size: 14px; text-align: center;">Customer,</p>
                            <div style="margin-top: 50px; border-top: 2px solid #000000; padding-top: 10px; font-weight: 600; font-size: 16px; text-align: center; width: 100%;">
                                {{ $booking->customer->full_name ?? '_________________' }}
                            </div>
                            <p style="color: #6c757d; font-size: 12px; margin-top: 5px; text-align: center;">Pembeli</p>
                        </td>
                    </tr>
                </table>

                <!-- FOOTER -->
                <div class="footer-note">
                    <p>Dokumen ini sah dan dicetak secara elektronik</p>
                    <p>Invoice ini merupakan bukti pembayaran lunas yang valid</p>
                    <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
                </div>

                <!-- QR CODE -->
                <div class="qr-container">
                    <div class="qr-box">
                        @if(isset($qrCodeSvg) && $qrCodeSvg)
                            {!! $qrCodeSvg !!}
                        @else
                            <svg width="90" height="90" viewBox="0 0 100 100" style="border:1px solid #ddd;">
                                <rect width="100" height="100" fill="white"/>
                                <rect x="15" y="15" width="16" height="16" fill="#4b49ac"/>
                                <rect x="40" y="15" width="16" height="16" fill="#4b49ac"/>
                                <rect x="65" y="15" width="16" height="16" fill="#4b49ac"/>
                                <rect x="15" y="40" width="16" height="16" fill="#4b49ac"/>
                                <rect x="40" y="40" width="16" height="16" fill="#4b49ac"/>
                                <rect x="65" y="40" width="16" height="16" fill="#4b49ac"/>
                                <rect x="15" y="65" width="16" height="16" fill="#4b49ac"/>
                                <rect x="40" y="65" width="16" height="16" fill="#4b49ac"/>
                                <rect x="65" y="65" width="16" height="16" fill="#4b49ac"/>
                            </svg>
                        @endif
                        <div class="qr-text"></div>
                    </div>
                </div>
            </div>
        </div>

        @if(!isset($pdf) || !$pdf)
        <div class="alert alert-info d-print-none" style="background:#e8ecf5;padding:12px;border-radius:8px;margin-top:10px;">
            <i class="mdi mdi-information-outline"></i> Dokumen ini dilengkapi watermark "PT PROPERTI MANAGEMENT" untuk keamanan.
        </div>
        @endif
    </div>

    @if(!isset($pdf) || !$pdf)
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const originalNumber = $('#invoiceNumber').text();

            $('#btnCashAwal').click(function() {
                $(this).addClass('active').siblings().removeClass('active');
                $('#invoiceTitle').text('INVOICE CASH KERAS (LUNAS LANGSUNG)');
                $('#invoiceNumber').text(originalNumber);
                $('#jenisCash').text('Cash Keras (Lunas Langsung)');
                $('#statusBadge').removeClass('badge-warning').addClass('badge-success').text('{{ $status }}');
                $('#infoKonversi').addClass('d-none');
            });

            $('#btnKonversi').click(function() {
                $(this).addClass('active').siblings().removeClass('active');
                $('#invoiceTitle').text('INVOICE CASH KERAS (KONVERSI DARI KPR)');
                $('#invoiceNumber').text(originalNumber.replace('CASH', 'CASH-KONV'));
                $('#jenisCash').text('Cash Keras (Konversi dari KPR)');
                $('#statusBadge').removeClass('badge-success').addClass('badge-warning').text('LUNAS (Konversi)');
                $('#infoKonversi').removeClass('d-none');
            });
        });
    </script>
    @endif
</body>
</html>
