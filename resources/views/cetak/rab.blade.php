{{-- resources/views/cetak/rab.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RAB Pembangunan - Properti Management</title>

    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <style>
        /* Style khusus untuk RAB */
        body {
            background-color: #f5f7fa;
            padding: 20px;
            font-family: 'Roboto', sans-serif;
            position: relative;
        }

        .rab-container {
            max-width: 1200px;
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
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
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

        .btn-container { margin-bottom: 20px; }
        .btn { padding: 8px 16px; border-radius: 4px; border: none; cursor: pointer; font-size: 14px; display: inline-flex; align-items: center; gap: 5px; }
        .btn-primary { background: linear-gradient(45deg, #4b49ac, #7a78c5); color: white; }
        .btn-success { background: linear-gradient(45deg, #00d25b, #028a44); color: white; }
        .btn-outline-secondary { border: 1px solid #6c757d; color: #6c757d; background: white; }

        .rab-content {
            background: white;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
        }

        .header-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-title h2 {
            color: #4b49ac;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .header-title h4 {
            color: #333;
            font-weight: bold;
            margin-top: 10px;
            text-decoration: underline;
        }

        .info-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f8f9fc;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            padding: 5px;
            border: none;
        }

        .info-table td:first-child {
            width: 150px;
            font-weight: bold;
        }

        .section-title {
            background-color: #4b49ac;
            color: white;
            padding: 8px 12px;
            margin: 20px 0 10px 0;
            font-weight: bold;
            font-size: 16px;
        }

        .rab-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 12px;
        }

        .rab-table th {
            background-color: #e9ecef;
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
            font-weight: 600;
        }

        .rab-table td {
            border: 1px solid #dee2e6;
            padding: 6px 8px;
            vertical-align: top;
        }

        .rab-table td:last-child {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .subtotal-row {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .grand-total {
            background-color: #4b49ac;
            color: white;
            font-weight: bold;
        }

        .footer-note {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }

        /* Mode cetak */
        @media print {
            @page {
                size: A4 landscape;
                margin: 1cm;
            }

            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .btn-container,
            .d-print-none {
                display: none !important;
            }

            .rab-content {
                padding: 0;
                box-shadow: none;
            }

            .section-title {
                background-color: #4b49ac !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .grand-total {
                background-color: #4b49ac !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .rab-table th {
                background-color: #e9ecef !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
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
        }

        /* Responsive */
        @media (max-width: 768px) {
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

    <div class="rab-container">
        <!-- Tombol Navigasi -->
        <div class="btn-container d-print-none">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <a href="{{ route('properti.progress', $unit->id) }}" class="btn btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-2"></i> Kembali
                    </a>
                </div>
                <div>
                    <button class="btn btn-primary me-2" onclick="window.print()">
                        <i class="mdi mdi-printer me-2"></i> Cetak RAB
                    </button>
                </div>
            </div>
            <div class="alert alert-info">
                <i class="mdi mdi-information-outline me-2"></i>
                Halaman ini dioptimalkan untuk cetak format A4 Landscape (seperti Excel)
            </div>
        </div>

        <div class="rab-content">
            <!-- Header -->
            <div class="header-title">
                <h2>PT PROPERTI MANAGEMENT</h2>
                <p>Jl. Sudirman No. 123, Jakarta Selatan 12190</p>
                <p>Telp: (021) 1234567 | Email: info@propertimanagement.com</p>
                <h4>RENCANA ANGGARAN BIAYA (RAB) PEMBANGUNAN</h4>
            </div>

            <!-- Info Proyek -->
            <div class="info-box">
                <table class="info-table">
                    <tr>
                        <td>Nama Proyek</td>
                        <td>: {{ $unit->landBank->name }}</td>
                        <td>Unit / Type</td>
                        <td>: {{ $unit->block . ' - ' . $unit->unit_number . ' / ' . $unit->type }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>: {{ $unit->landBank->address }}</td>
                        <td>Luas Tanah / Bangunan</td>
                        <td>: {{ $unit->area }} m² / {{ $unit->building_area }} m²</td>
                    </tr>
                    <tr>
                        <td>No. RAB</td>
                        <td>: {{ $unit->no_rab ?? 'RAB/' . date('Y/m/d') }}</td>
                        <td>Tanggal</td>
                        <td>: {{ date('d F Y') }}</td>
                    </tr>
                </table>
            </div>

            @php
                $categories = $progressItems->groupBy('kategori'); // pastikan kolom kategori ada di tabel rabs
                $grandTotal = 0;
            @endphp

            @foreach($categories as $kategori => $items)
                <div class="section-title">{{ $kategori }}</div>
                <table class="rab-table" border="1" cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Uraian Pekerjaan</th>
                            <th>Volume</th>
                            <th>Satuan</th>
                            <th>Harga Satuan (Rp)</th>
                            <th>Total (Rp)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->uraian }}</td>
                                <td class="text-end">{{ $item->volume }}</td>
                                <td>{{ $item->satuan }}</td>
                                <td class="text-end">{{ number_format($item->harga_satuan,0,",",".") }}</td>
                                <td class="text-end">{{ number_format($item->total,0,",",".") }}</td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                            @php $subtotal += $item->total; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="subtotal-row">
                            <td colspan="5" class="text-end">SUB TOTAL {{ $kategori }}</td>
                            <td class="text-end">{{ number_format($subtotal,0,",",".") }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                @php $grandTotal += $subtotal; @endphp
            @endforeach

            {{-- GRAND TOTAL --}}
            <table class="rab-table grand-total" border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <td colspan="5" class="text-end">GRAND TOTAL</td>
                    <td class="text-end">{{ number_format($grandTotal,0,",",".") }}</td>
                    <td></td>
                </tr>
            </table>

            <div class="footer-note">
                Dokumen ini dicetak dari sistem Properti Management. Semua harga dalam Rupiah (Rp).
                <br>
                <small class="text-muted">Dokumen dilengkapi watermark untuk keamanan</small>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
</body>
</html>
