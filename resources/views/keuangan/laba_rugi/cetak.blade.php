<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Laba Rugi - ERP Keuangan</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #111;
            background: #fff;
            margin: 0;
            padding: 25px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h3 {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .header h4 {
            font-size: 13pt;
            margin: 3px 0;
        }
        .header p {
            font-size: 10pt;
            margin: 0;
            color: #555;
        }
        .meta-table {
            width: 100%;
            margin-bottom: 20px;
            font-size: 10pt;
        }
        .statement-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10.5pt;
        }
        .statement-table td {
            padding: 6px 10px;
            vertical-align: middle;
        }
        .section-header {
            font-weight: bold;
            background-color: #f2f2f2;
            text-transform: uppercase;
            border-top: 1px solid #333;
            border-bottom: 1px solid #333;
        }
        .item-row td:first-child {
            padding-left: 25px !important;
        }
        .subtotal-row {
            font-weight: bold;
            border-top: 1px solid #777;
            border-bottom: 1px solid #777;
        }
        .highlight-row {
            font-weight: bold;
            font-size: 11pt;
            background-color: #e9ecef;
            border-top: 1.5px solid #000;
            border-bottom: 1.5px solid #000;
        }
        .net-profit-row {
            font-weight: bold;
            font-size: 12pt;
            background-color: #d1e7dd;
            border-top: 2px solid #000;
            border-bottom: 2px double #000;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .signature-table {
            width: 100%;
            margin-top: 45px;
            page-break-inside: avoid;
        }
        .signature-table td {
            text-align: center;
            vertical-align: bottom;
            height: 90px;
        }
        @media print {
            body { padding: 0; }
            .no-print { display: none !important; }
            @page {
                size: A4 portrait;
                margin: 2cm 1.5cm;
            }
        }
    </style>
</head>
<body>
    <div class="no-print mb-3 text-end">
        <button onclick="window.print()" class="btn btn-primary btn-sm px-4 fw-bold">
            <i class="mdi mdi-printer"></i> Cetak / Simpan PDF
        </button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm px-3">
            Tutup
        </button>
    </div>

    <div class="header">
        <h3>PT GRAHA CIPTA SEJAHTERA</h3>
        <h4>LAPORAN LABA RUGI (INCOME STATEMENT)</h4>
        <p>Proyek: {{ $selectedProject ? $selectedProject->nama_land_bank : 'Semua Proyek (Konsolidasi)' }} | Periode: {{ date('d F Y', strtotime($startDate)) }} s/d {{ date('d F Y', strtotime($endDate)) }}</p>
    </div>

    <table class="meta-table">
        <tr>
            <td style="width: 20%;">Tanggal Cetak</td>
            <td style="width: 30%;">: {{ date('d/m/Y H:i') }} WIB</td>
            <td style="width: 20%;">Dicetak Oleh</td>
            <td style="width: 30%;">: {{ auth()->user()->name ?? 'Staff Keuangan' }}</td>
        </tr>
    </table>

    <table class="statement-table">
        {{-- PENDAPATAN --}}
        <tr class="section-header">
            <td colspan="2">1. PENDAPATAN USAHA (REVENUE)</td>
        </tr>
        @forelse($report['revenue_data'] as $rev)
            <tr class="item-row">
                <td>[{{ $rev['account']->code }}] {{ $rev['account']->name }}</td>
                <td class="text-right">Rp {{ number_format($rev['balance'], 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr class="item-row">
                <td style="font-style: italic; color: #777;">- Tidak ada pendapatan pada periode ini</td>
                <td class="text-right">Rp 0</td>
            </tr>
        @endforelse
        <tr class="subtotal-row">
            <td>TOTAL PENDAPATAN:</td>
            <td class="text-right">Rp {{ number_format($report['total_revenue'], 0, ',', '.') }}</td>
        </tr>

        {{-- HPP --}}
        <tr><td colspan="2" style="height: 12px;"></td></tr>
        <tr class="section-header">
            <td colspan="2">2. HARGA POKOK PENJUALAN (HPP PROYEK)</td>
        </tr>
        @forelse($report['cogs_data'] as $cogs)
            <tr class="item-row">
                <td>[{{ $cogs['account']->code }}] {{ $cogs['account']->name }}</td>
                <td class="text-right">(Rp {{ number_format($cogs['balance'], 0, ',', '.') }})</td>
            </tr>
        @empty
            <tr class="item-row">
                <td style="font-style: italic; color: #777;">- Tidak ada HPP pada periode ini</td>
                <td class="text-right">Rp 0</td>
            </tr>
        @endforelse
        <tr class="subtotal-row">
            <td>TOTAL HARGA POKOK PENJUALAN (HPP):</td>
            <td class="text-right">(Rp {{ number_format($report['total_cogs'], 0, ',', '.') }})</td>
        </tr>

        {{-- LABA KOTOR --}}
        <tr><td colspan="2" style="height: 12px;"></td></tr>
        <tr class="highlight-row">
            <td>LABA KOTOR (GROSS PROFIT) [Margin: {{ number_format($report['gross_profit_margin'], 1) }}%]</td>
            <td class="text-right">Rp {{ number_format($report['gross_profit'], 0, ',', '.') }}</td>
        </tr>

        {{-- BEBAN OPERASIONAL --}}
        <tr><td colspan="2" style="height: 12px;"></td></tr>
        <tr class="section-header">
            <td colspan="2">3. BEBAN OPERASIONAL & PEMASARAN</td>
        </tr>
        @forelse($report['expense_data'] as $exp)
            <tr class="item-row">
                <td>[{{ $exp['account']->code }}] {{ $exp['account']->name }}</td>
                <td class="text-right">(Rp {{ number_format($exp['balance'], 0, ',', '.') }})</td>
            </tr>
        @empty
            <tr class="item-row">
                <td style="font-style: italic; color: #777;">- Tidak ada beban operasional tercatat</td>
                <td class="text-right">Rp 0</td>
            </tr>
        @endforelse
        <tr class="subtotal-row">
            <td>TOTAL BEBAN OPERASIONAL:</td>
            <td class="text-right">(Rp {{ number_format($report['total_expense'], 0, ',', '.') }})</td>
        </tr>

        {{-- LABA BERSIH --}}
        <tr><td colspan="2" style="height: 15px;"></td></tr>
        <tr class="net-profit-row">
            <td>LABA / (RUGI) BERSIH OPERASIONAL (NET INCOME) [Margin: {{ number_format($report['net_income_margin'], 1) }}%]</td>
            <td class="text-right">Rp {{ number_format($report['net_income'], 0, ',', '.') }}</td>
        </tr>
    </table>

    <table class="signature-table">
        <tr>
            <td style="width: 33%;">
                Dibuat Oleh,
                <br><br><br><br>
                <strong>( {{ auth()->user()->name ?? 'Staff Keuangan' }} )</strong><br>
                <span>Staff Akuntansi</span>
            </td>
            <td style="width: 33%;">
                Diperiksa Oleh,
                <br><br><br><br>
                <strong>( _______________________ )</strong><br>
                <span>Manager Keuangan</span>
            </td>
            <td style="width: 33%;">
                Disetujui Oleh,
                <br><br><br><br>
                <strong>( _______________________ )</strong><br>
                <span>Direktur Utama</span>
            </td>
        </tr>
    </table>
</body>
</html>
