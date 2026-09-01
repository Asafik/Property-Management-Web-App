<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Project Accounting & HPP - PT Properti Management</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f1f5f9;
            padding: 15px;
            color: #111827;
            font-size: 10px;
            line-height: 1.3;
        }

        .print-container {
            max-width: 320mm; /* F4 / Folio Landscape Width */
            margin: 0 auto;
            background: #ffffff;
            padding: 16px 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-radius: 6px;
        }

        /* Screen Action Bar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        .btn-action {
            padding: 6px 16px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 11px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
        }
        .btn-back {
            background: #ffffff;
            color: #475569;
            border: 1px solid #cbd5e1;
        }
        .btn-back:hover {
            background: #f8fafc;
            color: #0f172a;
        }
        .btn-print {
            background: #7c3aed;
            color: #ffffff;
            border: 1px solid #6d28d9;
        }
        .btn-print:hover {
            background: #6d28d9;
        }

        /* Kop Surat Resmi */
        .kop-surat {
            text-align: center;
            border-bottom: 2.5px double #1e293b;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        .kop-surat h2 {
            font-size: 15px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
            margin-bottom: 2px;
        }
        .kop-surat p {
            font-size: 9.5px;
            color: #475569;
        }

        /* Sub Header Laporan */
        .report-header {
            text-align: center;
            margin-bottom: 12px;
        }
        .report-header h3 {
            font-size: 12.5px;
            font-weight: 800;
            text-transform: uppercase;
            color: #0f172a;
            letter-spacing: 0.3px;
            margin-bottom: 2px;
        }
        .report-header p {
            font-size: 9.5px;
            color: #64748b;
        }

        /* Summary Cards (4 Columns Compact) */
        .summary-grid {
            display: table;
            width: 100%;
            margin-bottom: 12px;
            border-spacing: 6px 0;
            margin-left: -6px;
            margin-right: -6px;
        }
        .summary-col {
            display: table-cell;
            width: 25%;
            vertical-align: top;
        }
        .summary-box {
            border: 1px solid #cbd5e1;
            padding: 6px 10px;
            border-radius: 4px;
            background: #f8fafc;
        }
        .summary-box .label {
            font-size: 8.5px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            display: block;
            margin-bottom: 2px;
        }
        .summary-box .val {
            font-size: 11px;
            font-weight: 800;
            color: #0f172a;
            white-space: nowrap;
            display: block;
        }

        /* Table Report */
        table.table-report {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
            margin-bottom: 14px;
        }
        table.table-report th,
        table.table-report td {
            border: 1px solid #94a3b8;
            padding: 4px 5px;
            vertical-align: middle;
        }
        table.table-report th {
            background-color: #e2e8f0;
            color: #0f172a;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 8.5px;
            text-align: center;
            white-space: nowrap;
        }
        table.table-report tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .text-start { text-align: left !important; }
        .text-center { text-align: center !important; }
        .text-end { text-align: right !important; }
        .nowrap { white-space: nowrap !important; }
        .fw-bold { font-weight: 700 !important; }

        .status-badge {
            display: inline-block;
            padding: 1px 4px;
            border-radius: 3px;
            font-size: 7.5px;
            font-weight: 800;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .badge-sold { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .badge-booked { background: #dbeafe; color: #1e40af; border: 1px solid #93c5fd; }
        .badge-ready { background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; }

        /* Signature Section */
        .signature-table {
            width: 100%;
            border: none;
            margin-top: 15px;
            page-break-inside: avoid;
        }
        .signature-table td {
            border: none;
            text-align: center;
            padding: 0 10px;
            font-size: 9.5px;
        }
        .signature-space {
            height: 45px;
        }
        .signature-line {
            border-top: 1px solid #1e293b;
            width: 160px;
            margin: 0 auto;
            font-weight: 700;
            padding-top: 3px;
            color: #0f172a;
            font-size: 9.5px;
        }

        /* Print Specific Styling */
        @page {
            size: landscape;
            margin: 8mm 10mm;
        }

        @media print {
            @page {
                size: landscape;
                margin: 8mm 10mm;
            }
            body {
                background: #ffffff;
                padding: 0;
                font-size: 8.8px;
            }
            .print-container {
                max-width: 100%;
                width: 100%;
                box-shadow: none;
                border: none;
                padding: 0;
                border-radius: 0;
            }
            .d-print-none {
                display: none !important;
            }
            table.table-report th {
                background-color: #e2e8f0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .summary-box {
                background-color: #f8fafc !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <div class="print-container">
        <!-- Screen Only Buttons -->
        <div class="action-bar d-print-none">
            <button onclick="window.close(); if(!window.closed){ history.back(); }" class="btn-action btn-back">
                &larr; Tutup / Kembali
            </button>
            <button onclick="window.print()" class="btn-action btn-print">
                Cetak / Simpan PDF (Kertas F4 Landscape)
            </button>
        </div>

        <!-- Kop Surat -->
        <div class="kop-surat">
            <h2>PT PROPERTI MANAGEMENT</h2>
            <p>Jl. Sudirman No. 123, Jakarta Selatan 12190 &bull; Telp: (021) 1234567 &bull; Email: finance@propertimanagement.com</p>
        </div>

        <!-- Judul Laporan -->
        <div class="report-header">
            <h3>LAPORAN PROJECT ACCOUNTING, HPP & LABA RUGI KAVLING</h3>
            <p>
                Project: <strong>{{ $selectedProject->name ?? 'Semua Project' }}</strong> &bull;
                Dicetak pada: <strong>{{ date('d F Y, H:i') }} WIB</strong>
            </p>
        </div>

        <!-- Summary Grid 4 Cards -->
        <div class="summary-grid">
            <div class="summary-col">
                <div class="summary-box">
                    <span class="label">Total Potensi Revenue</span>
                    <span class="val">Rp {{ number_format($summary['total_revenue_potential'], 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="summary-col">
                <div class="summary-box">
                    <span class="label">Realisasi Kas Masuk</span>
                    <span class="val" style="color:#15803d;">Rp {{ number_format($summary['total_cash_inflow'], 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="summary-col">
                <div class="summary-box">
                    <span class="label">Total HPP Komitmen Proyek</span>
                    <span class="val" style="color:#b91c1c;">Rp {{ number_format($summary['total_hpp_project'], 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="summary-col">
                <div class="summary-box">
                    <span class="label">Proyeksi Laba Kotor (Margin {{ $summary['avg_margin_persen'] }}%)</span>
                    <span class="val" style="color:#4338ca;">Rp {{ number_format($summary['total_gross_profit'], 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Main Data Table (Clean F4 Layout with No-Wrap Currency) -->
        <table class="table-report">
            <thead>
                <tr>
                    <th style="width: 2.5%;">NO</th>
                    <th style="width: 11%;">PROJECT</th>
                    <th style="width: 10%;">BLOK & KAVLING</th>
                    <th style="width: 11%;">KONSUMEN</th>
                    <th style="width: 6%;">STATUS</th>
                    <th class="text-end" style="width: 9%;">HARGA JUAL</th>
                    <th class="text-end" style="width: 8%;">BIAYA TANAH</th>
                    <th class="text-end" style="width: 8%;">BIAYA SPK</th>
                    <th class="text-end" style="width: 7%;">RAB / SERVIS</th>
                    <th class="text-end" style="width: 9%; background:#cbd5e1;">TOTAL HPP</th>
                    <th class="text-end" style="width: 9%;">GROSS PROFIT</th>
                    <th class="text-center" style="width: 5%;">MARGIN</th>
                    <th class="text-end" style="width: 8.5%;">KAS MASUK</th>
                </tr>
            </thead>
            <tbody>
                @forelse($unitFinancials as $idx => $uf)
                    <tr>
                        <td class="text-center">{{ $idx + 1 }}</td>
                        <td class="text-start">{{ $uf->project_name }}</td>
                        <td class="text-start">
                            <strong>{{ $uf->block_code }}</strong>
                            <small style="color: #64748b; display: block; font-size: 8px;">{{ $uf->unit_name }}</small>
                        </td>
                        <td class="text-start">
                            <strong>{{ $uf->customer_name }}</strong>
                            @if($uf->booking_code !== '-')
                                <small style="color: #64748b; display: block; font-size: 7.5px;">{{ $uf->booking_code }}</small>
                            @endif
                        </td>
                        <td class="text-center nowrap">
                            @if($uf->status === 'sold')
                                <strong style="color: #15803d; font-size: 8.5px;">TERJUAL</strong>
                            @elseif($uf->status === 'booked')
                                <strong style="color: #2563eb; font-size: 8.5px;">BOOKING</strong>
                            @else
                                <strong style="color: #475569; font-size: 8.5px;">READY</strong>
                            @endif
                        </td>
                        <td class="text-end nowrap">Rp {{ number_format($uf->harga_jual, 0, ',', '.') }}</td>
                        <td class="text-end nowrap" style="color:#64748b;">Rp {{ number_format($uf->biaya_tanah, 0, ',', '.') }}</td>
                        <td class="text-end nowrap" style="color:#64748b;">Rp {{ number_format($uf->biaya_spk_kontrak, 0, ',', '.') }}</td>
                        <td class="text-end nowrap" style="color:#64748b;">Rp {{ number_format($uf->biaya_rab + $uf->biaya_servis, 0, ',', '.') }}</td>
                        <td class="text-end nowrap fw-bold" style="color: #b91c1c; background:#fef2f2;">
                            Rp {{ number_format($uf->total_hpp_komitmen, 0, ',', '.') }}
                        </td>
                        <td class="text-end nowrap fw-bold" style="color: {{ $uf->gross_profit >= 0 ? '#15803d' : '#b91c1c' }};">
                            Rp {{ number_format($uf->gross_profit, 0, ',', '.') }}
                        </td>
                        <td class="text-center fw-bold">{{ $uf->margin_persen }}%</td>
                        <td class="text-end nowrap" style="color: #15803d; font-weight: 700;">
                            Rp {{ number_format($uf->uang_masuk_konsumen, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center" style="padding: 12px; color:#64748b;">
                            Tidak ada data unit kavling untuk dicetak.
                        </td>
                    </tr>
                @endforelse
                <!-- Total Keseluruhan Row -->
                <tr style="background:#e2e8f0; font-weight:bold;">
                    <td colspan="5" class="text-center">TOTAL KESELURUHAN</td>
                    <td class="text-end nowrap">Rp {{ number_format($summary['total_revenue_potential'], 0, ',', '.') }}</td>
                    <td class="text-end nowrap">-</td>
                    <td class="text-end nowrap">-</td>
                    <td class="text-end nowrap">-</td>
                    <td class="text-end nowrap" style="color:#b91c1c;">Rp {{ number_format($summary['total_hpp_project'], 0, ',', '.') }}</td>
                    <td class="text-end nowrap" style="color: {{ $summary['total_gross_profit'] >= 0 ? '#15803d' : '#b91c1c' }};">
                        Rp {{ number_format($summary['total_gross_profit'], 0, ',', '.') }}
                    </td>
                    <td class="text-center">{{ $summary['avg_margin_persen'] }}%</td>
                    <td class="text-end nowrap" style="color:#15803d;">Rp {{ number_format($summary['total_cash_inflow'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Signature Block -->
        <table class="signature-table">
            <tr>
                <td style="width: 33.33%;">
                    <p>Dibuat Oleh,</p>
                    <div class="signature-space"></div>
                    <div class="signature-line">Finance & Accounting</div>
                </td>
                <td style="width: 33.33%;">
                    <p>Diperiksa Oleh,</p>
                    <div class="signature-space"></div>
                    <div class="signature-line">Project Manager</div>
                </td>
                <td style="width: 33.33%;">
                    <p>Disetujui Oleh,</p>
                    <div class="signature-space"></div>
                    <div class="signature-line">Direktur Utama</div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
