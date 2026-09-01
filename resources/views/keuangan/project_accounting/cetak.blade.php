<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Project Accounting & HPP - PT Properti Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.9.55/css/materialdesignicons.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Times New Roman', Times, serif !important;
            background-color: #f8fafc;
            padding: 30px 20px;
            color: #1e293b;
        }
        .print-container {
            max-width: 297mm; /* A4 Landscape */
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border-radius: 8px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #334155;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header h2 { font-size: 20px; font-weight: bold; text-transform: uppercase; margin-bottom: 4px; }
        .header p { font-size: 12px; color: #64748b; margin-bottom: 2px; }

        .report-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .report-title h3 { font-size: 16px; font-weight: bold; text-transform: uppercase; }
        .report-title p { font-size: 12px; color: #64748b; }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }
        .summary-box {
            border: 1px solid #cbd5e1;
            padding: 10px;
            border-radius: 6px;
            background: #f8fafc;
        }
        .summary-box span { font-size: 11px; color: #64748b; display: block; }
        .summary-box strong { font-size: 14px; color: #0f172a; font-family: monospace; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            vertical-align: middle;
        }
        th {
            background-color: #f1f5f9;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .font-mono { font-family: monospace; }

        .signature-table {
            width: 100%;
            border: none;
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .signature-table td {
            border: none;
            text-align: center;
            padding: 10px;
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 1.2cm;
            }
            body { background: white; padding: 0; }
            .print-container { max-width: 100%; box-shadow: none; padding: 0; }
            .d-print-none { display: none !important; }
        }
    </style>
</head>
<body>

    <div class="print-container">
        <div class="d-print-none" style="display:flex; justify-content:space-between; margin-bottom: 20px;">
            <button onclick="window.close(); if(!window.closed){ history.back(); }" style="padding: 6px 16px; cursor: pointer;">
                <i class="mdi mdi-arrow-left"></i> Tutup
            </button>
            <button onclick="window.print()" style="padding: 6px 20px; background:#4b49ac; color:white; border:none; border-radius:4px; font-weight:bold; cursor: pointer;">
                <i class="mdi mdi-printer"></i> Cetak / Simpan PDF (A4 Landscape)
            </button>
        </div>

        <div class="header">
            <h2>PT PROPERTI MANAGEMENT</h2>
            <p>Jl. Sudirman No. 123, Jakarta Selatan 12190 | Telp: (021) 1234567 | Email: finance@propertimanagement.com</p>
        </div>

        <div class="report-title">
            <h3>LAPORAN PROJECT ACCOUNTING, HPP & LABA RUGI KAVLING</h3>
            <p>
                Project: <strong>{{ $selectedProject->name ?? 'Semua Project' }}</strong> |
                Dicetak pada: <strong>{{ date('d F Y, H:i') }} WIB</strong>
            </p>
        </div>

        <div class="summary-grid">
            <div class="summary-box">
                <span>Total Potensi Revenue Penjualan</span>
                <strong>Rp {{ number_format($summary['total_revenue_potential'], 0, ',', '.') }}</strong>
            </div>
            <div class="summary-box">
                <span>Realisasi Kas Masuk Konsumen</span>
                <strong style="color:#15803d;">Rp {{ number_format($summary['total_cash_inflow'], 0, ',', '.') }}</strong>
            </div>
            <div class="summary-box">
                <span>Total HPP Komitmen Proyek</span>
                <strong style="color:#b91c1c;">Rp {{ number_format($summary['total_hpp_project'], 0, ',', '.') }}</strong>
            </div>
            <div class="summary-box">
                <span>Proyeksi Laba Kotor (Margin {{ $summary['avg_margin_persen'] }}%)</span>
                <strong style="color:#4338ca;">Rp {{ number_format($summary['total_gross_profit'], 0, ',', '.') }}</strong>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="4%">No</th>
                    <th>Project</th>
                    <th>Blok & Kavling</th>
                    <th>Konsumen & Status</th>
                    <th class="text-end">Harga Jual</th>
                    <th class="text-end">Biaya Tanah</th>
                    <th class="text-end">Biaya SPK</th>
                    <th class="text-end">RAB / Servis</th>
                    <th class="text-end">Total HPP</th>
                    <th class="text-end">Gross Profit</th>
                    <th class="text-center">Margin</th>
                    <th class="text-end">Kas Masuk</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unitFinancials as $idx => $uf)
                    <tr>
                        <td class="text-center">{{ $idx + 1 }}</td>
                        <td>{{ $uf->project_name }}</td>
                        <td><strong>{{ $uf->block_code }}</strong> ({{ $uf->unit_name }})</td>
                        <td>{{ $uf->customer_name }} [{{ strtoupper($uf->status) }}]</td>
                        <td class="text-end font-mono">Rp {{ number_format($uf->harga_jual, 0, ',', '.') }}</td>
                        <td class="text-end font-mono">Rp {{ number_format($uf->biaya_tanah, 0, ',', '.') }}</td>
                        <td class="text-end font-mono">Rp {{ number_format($uf->biaya_spk_kontrak, 0, ',', '.') }}</td>
                        <td class="text-end font-mono">Rp {{ number_format($uf->biaya_rab + $uf->biaya_servis, 0, ',', '.') }}</td>
                        <td class="text-end font-mono" style="font-weight:bold;">Rp {{ number_format($uf->total_hpp_komitmen, 0, ',', '.') }}</td>
                        <td class="text-end font-mono" style="font-weight:bold; color: {{ $uf->gross_profit >= 0 ? '#15803d' : '#b91c1c' }};">
                            Rp {{ number_format($uf->gross_profit, 0, ',', '.') }}
                        </td>
                        <td class="text-center">{{ $uf->margin_persen }}%</td>
                        <td class="text-end font-mono">Rp {{ number_format($uf->uang_masuk_konsumen, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr style="background:#f1f5f9; font-weight:bold;">
                    <td colspan="4" class="text-center">TOTAL KESELURUHAN</td>
                    <td class="text-end font-mono">Rp {{ number_format($summary['total_revenue_potential'], 0, ',', '.') }}</td>
                    <td class="text-end font-mono">-</td>
                    <td class="text-end font-mono">-</td>
                    <td class="text-end font-mono">-</td>
                    <td class="text-end font-mono">Rp {{ number_format($summary['total_hpp_project'], 0, ',', '.') }}</td>
                    <td class="text-end font-mono">Rp {{ number_format($summary['total_gross_profit'], 0, ',', '.') }}</td>
                    <td class="text-center">{{ $summary['avg_margin_persen'] }}%</td>
                    <td class="text-end font-mono">Rp {{ number_format($summary['total_cash_inflow'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <table class="signature-table">
            <tr>
                <td style="width:33%;">
                    <p>Dibuat Oleh,</p>
                    <div style="margin-top:55px; border-top:1px solid #333; display:inline-block; width:180px; font-weight:bold; padding-top:4px;">
                        Finance & Accounting
                    </div>
                </td>
                <td style="width:33%;">
                    <p>Diperiksa Oleh,</p>
                    <div style="margin-top:55px; border-top:1px solid #333; display:inline-block; width:180px; font-weight:bold; padding-top:4px;">
                        Project Manager
                    </div>
                </td>
                <td style="width:33%;">
                    <p>Disetujui Oleh,</p>
                    <div style="margin-top:55px; border-top:1px solid #333; display:inline-block; width:180px; font-weight:bold; padding-top:4px;">
                        Direktur Utama
                    </div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
