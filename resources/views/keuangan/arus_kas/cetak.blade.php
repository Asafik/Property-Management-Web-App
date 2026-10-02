<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Arus Kas - ERP Keuangan</title>
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
        .group-header {
            font-weight: bold;
            padding-left: 20px !important;
            font-style: italic;
        }
        .item-row td:first-child {
            padding-left: 35px !important;
        }
        .subtotal-row {
            font-weight: bold;
            border-top: 1px solid #777;
            border-bottom: 1px solid #777;
        }
        .total-row {
            font-weight: bold;
            font-size: 11pt;
            background-color: #e9ecef;
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
        <h4>LAPORAN ARUS KAS (STATEMENT OF CASH FLOWS)</h4>
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
        {{-- I. OPERASI --}}
        <tr class="section-header">
            <td colspan="2">I. ARUS KAS DARI AKTIVITAS OPERASI</td>
        </tr>
        <tr class="group-header">
            <td colspan="2">Penerimaan Kas Operasional:</td>
        </tr>
        @forelse($report['operating_inflows'] as $item)
            <tr class="item-row">
                <td>{{ $item->description }} ({{ $item->entry_number }})</td>
                <td class="text-right">Rp {{ number_format($item->total_amount, 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr class="item-row">
                <td style="font-style: italic; color: #777;">- Tidak ada penerimaan operasional</td>
                <td class="text-right">Rp 0</td>
            </tr>
        @endforelse

        <tr class="group-header">
            <td colspan="2">Pengeluaran Kas Operasional:</td>
        </tr>
        @forelse($report['operating_outflows'] as $item)
            <tr class="item-row">
                <td>{{ $item->description }} ({{ $item->entry_number }})</td>
                <td class="text-right">(Rp {{ number_format($item->total_amount, 0, ',', '.') }})</td>
            </tr>
        @empty
            <tr class="item-row">
                <td style="font-style: italic; color: #777;">- Tidak ada pengeluaran operasional</td>
                <td class="text-right">Rp 0</td>
            </tr>
        @endforelse
        <tr class="subtotal-row">
            <td>Arus Kas Bersih dari Aktivitas Operasi</td>
            <td class="text-right">Rp {{ number_format($report['net_operating'], 0, ',', '.') }}</td>
        </tr>

        {{-- II. INVESTASI --}}
        <tr><td colspan="2" style="height: 12px;"></td></tr>
        <tr class="section-header">
            <td colspan="2">II. ARUS KAS DARI AKTIVITAS INVESTASI & PROYEK</td>
        </tr>
        @if($report['investing_inflows']->isNotEmpty())
            <tr class="group-header">
                <td colspan="2">Penerimaan Investasi:</td>
            </tr>
            @foreach($report['investing_inflows'] as $item)
                <tr class="item-row">
                    <td>{{ $item->description }}</td>
                    <td class="text-right">Rp {{ number_format($item->total_amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        @endif
        <tr class="group-header">
            <td colspan="2">Pengeluaran Investasi (Tanah & Konstruksi Proyek):</td>
        </tr>
        @forelse($report['investing_outflows'] as $item)
            <tr class="item-row">
                <td>{{ $item->description }} ({{ $item->entry_number }})</td>
                <td class="text-right">(Rp {{ number_format($item->total_amount, 0, ',', '.') }})</td>
            </tr>
        @empty
            <tr class="item-row">
                <td style="font-style: italic; color: #777;">- Tidak ada pengeluaran investasi proyek</td>
                <td class="text-right">Rp 0</td>
            </tr>
        @endforelse
        <tr class="subtotal-row">
            <td>Arus Kas Bersih dari Aktivitas Investasi & Proyek</td>
            <td class="text-right">Rp {{ number_format($report['net_investing'], 0, ',', '.') }}</td>
        </tr>

        {{-- III. PENDANAAN --}}
        <tr><td colspan="2" style="height: 12px;"></td></tr>
        <tr class="section-header">
            <td colspan="2">III. ARUS KAS DARI AKTIVITAS PENDANAAN</td>
        </tr>
        <tr class="group-header">
            <td colspan="2">Penerimaan Pendanaan & Fasilitas KPR Bank:</td>
        </tr>
        @forelse($report['financing_inflows'] as $item)
            <tr class="item-row">
                <td>{{ $item->description }} ({{ $item->entry_number }})</td>
                <td class="text-right">Rp {{ number_format($item->total_amount, 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr class="item-row">
                <td style="font-style: italic; color: #777;">- Tidak ada penerimaan pendanaan</td>
                <td class="text-right">Rp 0</td>
            </tr>
        @endforelse
        <tr class="subtotal-row">
            <td>Arus Kas Bersih dari Aktivitas Pendanaan</td>
            <td class="text-right">Rp {{ number_format($report['net_financing'], 0, ',', '.') }}</td>
        </tr>

        {{-- REKAP AKHIR --}}
        <tr><td colspan="2" style="height: 15px;"></td></tr>
        <tr class="total-row">
            <td>KENAIKAN / (PENURUNAN) BERSIH KAS & SETARA KAS</td>
            <td class="text-right">Rp {{ number_format($report['net_cash_flow'], 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="padding-top: 10px;">Saldo Kas & Setara Kas pada Awal Periode</td>
            <td class="text-right" style="padding-top: 10px;">Rp {{ number_format($report['saldo_awal'], 0, ',', '.') }}</td>
        </tr>
        <tr class="total-row" style="background-color: #d1e7dd;">
            <td>SALDO KAS & SETARA KAS PADA AKHIR PERIODE</td>
            <td class="text-right">Rp {{ number_format($report['saldo_akhir'], 0, ',', '.') }}</td>
        </tr>
    </table>

    <table class="signature-table">
        <tr>
            <td style="width: 33%;">
                Dibuat Oleh,
                <br><br><br><br>
                <strong>( {{ auth()->user()->name ?? 'Staff Keuangan' }} )</strong><br>
                <span>Staff Keuangan & Kasir</span>
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
