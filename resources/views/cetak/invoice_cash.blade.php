<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice Cash Keras - Properti Management</title>

    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <style>
        /* Style khusus untuk invoice */
        body {
            background-color: #f5f7fa;
            padding: 20px;
            font-family: 'Roboto', sans-serif;
            position: relative;
        }

        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
        }

        /* Watermark PT PROPERTI MANAGEMENT */
        .watermark-text {
            user-select: none;
            font-size: 80px;
            color: rgba(75, 73, 172, 0.15);
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            white-space: nowrap;
            z-index: 999;
            pointer-events: none;
            font-weight: bold;
            border: 3px solid rgba(75, 73, 172, 0.1);
            padding: 20px 40px;
            border-radius: 15px;
            letter-spacing: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

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
            font-size: 60px;
            font-weight: bold;
            color: #4b49ac;
            margin: 50px;
            white-space: nowrap;
        }

        /* Style untuk tombol */
        .btn-container {
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4b49ac, #7a78c5);
            color: white;
            border: none;
        }

        .btn-success {
            background: linear-gradient(45deg, #00d25b, #028a44);
            color: white;
            border: none;
        }

        .btn-warning {
            background: linear-gradient(45deg, #ffab2e, #f16a0e);
            color: white;
            border: none;
        }

        .btn-outline-secondary {
            border: 1px solid #6c757d;
            color: #6c757d;
            background: white;
        }

        .btn.active {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Style untuk card */
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 30px;
        }

        /* Style untuk invoice */
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4b49ac;
            padding-bottom: 20px;
        }

        .invoice-header h2 {
            color: #4b49ac;
            margin-bottom: 5px;
        }

        .invoice-header p {
            color: #6c757d;
            margin: 2px 0;
        }

        .invoice-title {
            text-align: center;
            margin: 30px 0;
        }

        .invoice-title h3 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px dashed #4b49ac;
            padding-bottom: 10px;
            display: inline-block;
        }

        .info-section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f8f9fc;
            border-radius: 8px;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            padding: 8px 5px;
            border: none;
        }

        .info-table td:first-child {
            width: 150px;
            font-weight: bold;
            color: #555;
        }

        .info-table td:nth-child(2) {
            width: 20px;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .detail-table th {
            background-color: #4b49ac;
            color: white;
            padding: 12px;
            text-align: left;
        }

        .detail-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .detail-table tr:last-child td {
            border-bottom: none;
        }

        .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .total-row td {
            font-size: 16px;
        }

        .grand-total {
            background-color: #4b49ac;
            color: white;
        }

        .grand-total td {
            font-size: 18px;
            font-weight: bold;
        }

        .terbilang {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fc;
            border-left: 4px solid #4b49ac;
            font-style: italic;
            font-size: 16px;
        }

        .payment-method {
            margin: 20px 0;
            padding: 15px;
            border: 1px dashed #4b49ac;
            border-radius: 8px;
        }

        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            text-align: center;
            width: 45%;
        }

        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #333;
            padding-top: 10px;
        }

        .footer-note {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }

        .badge-status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #00d25b;
            color: white;
        }

        .badge-warning {
            background-color: #ffab2e;
            color: white;
        }

        .text-success {
            color: #00d25b;
        }

        .text-danger {
            color: #dc3545;
        }

        .text-muted {
            color: #6c757d;
        }

        .small {
            font-size: 12px;
        }

        .d-none {
            display: none;
        }

        /* Mode cetak */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .invoice-container {
                max-width: 100%;
            }

            .btn-container,
            .d-print-none {
                display: none !important;
            }

            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .watermark-text {
                opacity: 0.15;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color: #4b49ac;
            }

            .watermark-pattern span {
                opacity: 0.1;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .badge-status {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .signature-section {
                flex-direction: column;
                gap: 30px;
            }

            .signature-box {
                width: 100%;
            }

            .info-table td:first-child {
                width: 120px;
            }

            .watermark-text {
                font-size: 40px;
                padding: 10px 20px;
            }

            .watermark-pattern span {
                font-size: 30px;
                margin: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Watermark PT PROPERTI MANAGEMENT (besar di tengah) -->
    <div class="watermark-text">PT PROPERTI MANAGEMENT</div>

    <!-- Watermark pattern berulang -->
    <div class="watermark-pattern">
        <span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span>
        <span>PT PROPERTI MANAGEMENT</span>
    </div>

    <div class="invoice-container">
        <!-- Tombol Pilihan Skenario (tidak ikut print) -->
        <div class="btn-container d-print-none">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <button class="btn btn-outline-secondary" onclick="history.back()">
                        <i class="mdi mdi-arrow-left me-2"></i> Kembali
                    </button>
                </div>
                <div>
                    <button class="btn btn-primary me-2" onclick="window.print()">
                        <i class="mdi mdi-printer me-2"></i> Cetak Invoice
                    </button>
                    <button class="btn btn-success" id="btnDownloadPDF">
                        <i class="mdi mdi-download me-2"></i> Download PDF
                    </button>
                </div>
            </div>

            <!-- Toggle untuk pilih skenario -->
            <div class="d-flex justify-content-center mb-4">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-success active" id="btnCashAwal">
                        <i class="mdi mdi-cash me-1"></i> Cash Awal
                    </button>
                    <button type="button" class="btn btn-warning" id="btnKonversi">
                        <i class="mdi mdi-bank-off me-1"></i> Konversi dari KPR
                    </button>
                </div>
                <small class="text-muted ms-3 d-none d-md-inline">Klik untuk ganti jenis invoice</small>
            </div>
        </div>

        <!-- Card Invoice -->
        <div class="card">
            <div class="card-body">
                <!-- Header Perusahaan -->
                <div class="invoice-header">
                    <h2>PT PROPERTI MANAGEMENT</h2>
                    <p>Jl. Sudirman No. 123, Jakarta Selatan 12190</p>
                    <p>Telp: (021) 1234567 | Email: info@propertimanagement.com</p>
                    <p>NPWP: 01.234.567.8-123.000</p>
                </div>

                <!-- Judul Invoice (Berubah sesuai skenario) -->
                <div class="invoice-title">
                    <h3 id="invoiceTitle">INVOICE CASH KERAS (LUNAS LANGSUNG)</h3>
                </div>

                <!-- Nomor dan Tanggal Invoice -->
                <div class="row" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                    <div style="width: 48%;">
                        <table class="info-table">
                            <tr>
                                <td>No. Invoice</td>
                                <td>:</td>
                                <td><strong
                                        id="invoiceNumber">{{ $booking->invoice_number ?? 'INV/CASH/' . date('Y') . '/' . str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Invoice</td>
                                <td>:</td>
                                <td>{{ \Carbon\Carbon::parse($booking->invoice_date ?? $booking->created_at)->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Lunas</td>
                                <td>:</td>
                                <td>
                                    @php
                                        $pelunasan = $booking->payments->where('type', 'pelunasan')->first();
                                    @endphp
                                    {{ $pelunasan ? \Carbon\Carbon::parse($pelunasan->payment_date)->translatedFormat('d F Y') : '-' }}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div style="width: 48%;">
                        <table class="info-table">
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>
                                    @php
                                        $totalPaid = $booking->payments->sum('amount');
                                        $status =
                                            $totalPaid >= ($booking->harga_nego ?? $booking->unit->price)
                                                ? 'LUNAS'
                                                : 'BELUM LUNAS';
                                        $badgeClass = $status == 'LUNAS' ? 'badge-success' : 'badge-warning';
                                    @endphp
                                    <span class="badge-status {{ $badgeClass }}"
                                        id="statusBadge">{{ $status }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Cash</td>
                                <td>:</td>
                                <td>{{ $booking->type_cash ?? 'Cash Keras (Lunas Langsung)' }}</td>
                            </tr>
                            <tr>
                                <td>Metode</td>
                                <td>:</td>
                                <td>{{ $pelunasan->method ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Info Customer -->
                <div class="info-section">
                    <h5 style="margin-bottom: 15px; color: #4b49ac;">DATA CUSTOMER</h5>
                    <table class="info-table">
                        <tr>
                            <td>Nama Customer</td>
                            <td>:</td>
                            <td><strong>{{ $booking->customer->full_name ?? '-' }}</strong></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td>{{ $booking->customer->nik ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td>:</td>
                            <td>{{ $booking->customer->phone ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Booking ID</td>
                            <td>:</td>
                            <td>{{ $booking->booking_code ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Unit</td>
                            <td>:</td>
                            <td>{{ $booking->unit->type ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Blok/No</td>
                            <td>:</td>
                            <td>{{ $booking->unit->unit_code ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Detail Harga & Negosiasi -->
                <h5 style="margin-bottom: 15px; color: #4b49ac;">RINCIAN HARGA</h5>
                <table class="detail-table">
                    <tbody>
                        <tr>
                            <td width="60%"><strong>Harga Unit</strong></td>
                            <td width="40%" class="text-end">
                                {{ $booking->unit->price ? 'Rp ' . number_format($booking->unit->price, 0, ',', '.') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Hasil Negosiasi / Diskon</strong></td>
                            <td class="text-end text-success">-
                                {{ $booking->harga_nego ? 'Rp ' . number_format($booking->harga_nego, 0, ',', '.') : '-' }}
                            </td>
                        </tr>
                        <tr class="total-row">
                            <td><strong>Harga Final Kesepakatan</strong></td>
                            <td class="text-end">
                                <strong>{{ $booking->unit->price ? 'Rp ' . number_format($booking->unit->price - $booking->harga_nego, 0, ',', '.') : '-' }}</strong>
                            </td>
                        </tr>
                        <tr class="grand-total">
                            <td><strong>TOTAL PEMBAYARAN LUNAS</strong></td>
                            <td class="text-end">
                                <strong>{{ $booking->unit->price ? 'Rp ' . number_format($booking->unit->price - $booking->harga_nego, 0, ',', '.') : '-' }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Terbilang -->
                <div class="terbilang">
                    <strong>Terbilang:</strong>
                    {{ $booking->unit->price ? ucwords(\Illuminate\Support\Str::lower(\App\Helpers\Terbilang::make($booking->unit->price - ($booking->harga_nego ?? 0)))) . ' rupiah' : '-' }}
                </div>

                <!-- INFORMASI KHUSUS KONVERSI KPR (Muncul hanya untuk skenario konversi) -->
                <div id="infoKonversi" class="d-none">
                    <!-- Alert Warning -->
                    <div class="alert alert-warning"
                        style="background-color: #fff3cd; border: 1px solid #ffab2e; padding: 15px; border-radius: 8px; margin: 20px 0;">
                        <i class="mdi mdi-information-outline me-2"></i>
                        <strong>Catatan:</strong> Pembayaran ini merupakan konversi dari KPR yang ditolak.
                        <br>
                        <small>Biaya KPR hangus: Rp 4.100.000 (Biaya Survey + Biaya Provisi) - sudah termasuk dalam
                            perhitungan</small>
                    </div>

                    <!-- Lampiran Surat Penolakan -->
                    <div class="alert alert-light border" style="padding: 15px; border-radius: 8px; margin: 20px 0;">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-file-pdf text-danger me-3" style="font-size: 24px;"></i>
                            <div>
                                <strong>Surat Penolakan KPR</strong>
                                <p class="mb-0 small text-muted">Bank ABC Syariah - 25 Februari 2025</p>
                            </div>
                            <button class="btn btn-sm btn-outline-danger ms-auto">
                                <i class="mdi mdi-download me-1"></i> Download
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <!-- Metode Pembayaran -->
                <div class="payment-method">
                    <h5 style="margin-bottom: 10px; color: #4b49ac;">METODE PEMBAYARAN</h5>

                    @php
                        // Ambil pembayaran pelunasan terakhir
                        $pelunasan = $booking->payments->where('type', 'pelunasan')->first();
                    @endphp

                    <table class="info-table">
                        <tr>
                            <td>Metode</td>
                            <td>:</td>
                            <td>{{ $pelunasan->method ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Nama Bank</td>
                            <td>:</td>
                            <td>{{ $pelunasan->notes ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>No. Rekening</td>
                            <td>:</td>
                            <td>{{ $pelunasan->reference_number ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Atas Nama</td>
                            <td>:</td>
                            <td>{{ $pelunasan->notes ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Transfer</td>
                            <td>:</td>
                            <td>{{ $pelunasan ? \Carbon\Carbon::parse($pelunasan->payment_date)->translatedFormat('d F Y') : '-' }}
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Tanda Tangan -->
                <div class="signature-section">
                    <div class="signature-box">
                        <p>Penerima,</p>
                        <div class="signature-line">{{ $booking->sales->name ?? '-' }}</div>
                        <p class="text-muted small">{{ $booking->sales->role ?? '-' }}</p>
                    </div>
                    <div class="signature-box">
                        <p>Customer,</p>
                        <div class="signature-line">{{ $booking->customer->full_name ?? '-' }}</div>
                        <p class="text-muted small">Pembeli</p>
                    </div>
                </div>

                <!-- Footer Note -->
                <div class="footer-note">
                    <p>Dokumen ini sah dan dicetak secara elektronik</p>
                    <p>Invoice ini merupakan bukti pembayaran lunas yang valid</p>
                    <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
                </div>

         <!-- QR Code Simulasi untuk preview -->
<div style="text-align: right; margin-top: 20px;">
   <div style="text-align: right; margin-top: 20px;">
<div style="text-align: right;">
    {!! $qrCodeSvg !!}
    <p style="font-size: 10px;">Scan untuk download PDF</p>
</div>
</div>
</div>

            </div>
        </div>

        <!-- Informasi Watermark (tidak ikut print) -->
        <div class="alert alert-info d-print-none mt-3">
            <i class="mdi mdi-information-outline me-2"></i>
            Dokumen ini dilengkapi watermark "PT PROPERTI MANAGEMENT" untuk keamanan.
        </div>
    </div>

    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Toggle untuk 2 skenario
            $('#btnCashAwal').click(function() {
                // Aktifkan button
                $(this).addClass('active');
                $('#btnKonversi').removeClass('active');

                // Ubah judul invoice
                $('#invoiceTitle').text('INVOICE CASH KERAS (LUNAS LANGSUNG)');

                // Ubah nomor invoice
                $('#invoiceNumber').text('INV/CASH/2025/03/001');
                $('#qrCodeText').text('INV/CASH/2025/03/001');

                // Status badge tetap LUNAS (hijau)
                $('#statusBadge').removeClass('badge-warning').addClass('badge-success').text('LUNAS');

                // Sembunyikan info konversi
                $('#infoKonversi').addClass('d-none');
            });

            $('#btnKonversi').click(function() {
                // Aktifkan button
                $(this).addClass('active');
                $('#btnCashAwal').removeClass('active');

                // Ubah judul invoice
                $('#invoiceTitle').text('INVOICE CASH KERAS (KONVERSI DARI KPR)');

                // Ubah nomor invoice
                $('#invoiceNumber').text('INV/CASH-KONV/2025/03/001');
                $('#qrCodeText').text('INV/CASH-KONV/2025/03/001');

                // Status badge (warning untuk konversi)
                $('#statusBadge').removeClass('badge-success').addClass('badge-warning').text(
                    'LUNAS (Konversi)');

                // Tampilkan info konversi
                $('#infoKonversi').removeClass('d-none');
            });
            
        });
    </script>
    <script>
    document.getElementById('btnDownloadPDF').addEventListener('click', function() {
        // Gunakan ID booking dari Blade
        const bookingId = {{ $booking->id }};
        const url = `/dashboard-cetak-invoice-cash/${bookingId}/pdf`;
        
        // Buka PDF di tab baru
        window.open(url, '_blank');
    });
</script>
</body>

</html>
