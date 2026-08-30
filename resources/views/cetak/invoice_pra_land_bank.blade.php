<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pengadaan Lahan - {{ $land->land_name ?? 'Pra Land Bank' }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.9.55/css/materialdesignicons.min.css">

    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif !important;
            background-color: #f4f6f9;
            padding: 30px 20px;
            color: #1e293b;
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }

        body, .card, table, td, th, p, h1, h2, h3, h4, h5,
        .btn, .badge-status, .info-section, .footer-note, small, strong, span, div {
            font-family: 'Times New Roman', Times, serif !important;
        }

        .invoice-container {
            max-width: 210mm;
            width: 100%;
            margin: 0 auto;
            position: relative;
        }

        /* ===== TOMBOL AKSI ===== */
        .btn-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .btn {
            padding: 9px 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .btn-secondary {
            background-color: #64748b;
            color: #ffffff;
        }

        .btn-secondary:hover {
            background-color: #475569;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7e22ce, #9a55ff);
            color: #ffffff;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        /* ===== KARTU INVOICE ===== */
        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            padding: 35px 40px;
        }

        /* ===== KOP SURAT / HEADER PERUSAHAAN ===== */
        .company-header {
            border-bottom: 2px solid #1e293b;
            padding-bottom: 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .company-info h2 {
            font-size: 20px;
            font-weight: bold;
            color: #0f172a;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        .company-info p {
            font-size: 12px;
            color: #475569;
            line-height: 1.4;
        }

        .invoice-badge-title {
            text-align: right;
        }

        .invoice-badge-title h1 {
            font-size: 24px;
            font-weight: 900;
            color: #7e22ce;
            letter-spacing: 1.5px;
            margin-bottom: 4px;
        }

        .invoice-badge-title span {
            font-size: 13px;
            font-weight: bold;
            color: #334155;
            background: #f1f5f9;
            padding: 3px 8px;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
        }

        /* ===== INFO INVOICE & PIHAK TERKAIT ===== */
        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 22px;
        }

        .meta-box {
            background: #fafbfe;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px 16px;
        }

        .meta-box h5 {
            font-size: 13px;
            font-weight: bold;
            color: #7e22ce;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px dashed #cbd5e1;
            text-transform: uppercase;
        }

        .meta-table {
            width: 100%;
            font-size: 12.5px;
            border-collapse: collapse;
        }

        .meta-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .meta-table td:first-child {
            color: #64748b;
            width: 38%;
        }

        .meta-table td:nth-child(2) {
            width: 4%;
            text-align: center;
        }

        .meta-table td:last-child {
            color: #0f172a;
            font-weight: 600;
            width: 58%;
        }

        /* ===== TABEL RINCIAN ===== */
        .table-title {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 12.5px;
        }

        .table-custom th {
            background-color: #f1f5f9;
            color: #0f172a;
            font-weight: bold;
            text-align: left;
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
        }

        .table-custom td {
            padding: 7px 10px;
            border: 1px solid #e2e8f0;
            color: #334155;
        }

        .table-custom tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        .text-end {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .fw-bold {
            font-weight: bold;
        }

        .grand-total-row td {
            background-color: rgba(126, 34, 206, 0.08) !important;
            color: #7e22ce !important;
            font-size: 14px;
            font-weight: bold;
            border-top: 2px solid #7e22ce !important;
            border-bottom: 2px solid #7e22ce !important;
        }

        /* ===== TERBILANG BOX ===== */
        .terbilang-box {
            background-color: #f8fafc;
            border: 1px dashed #cbd5e1;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-style: italic;
            color: #334155;
            margin-bottom: 20px;
        }

        /* ===== TANDA TANGAN ===== */
        .signature-section {
            margin-top: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
            text-align: center;
            page-break-inside: avoid;
        }

        .signature-box {
            font-size: 12px;
            line-height: 1.4;
        }

        .signature-role {
            font-weight: bold;
            color: #475569;
            margin-bottom: 60px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            color: #0f172a;
        }

        .signature-note {
            font-size: 11px;
            color: #64748b;
        }

        /* ===== FOOTER NOTE ===== */
        .footer-note {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            font-size: 11px;
            color: #94a3b8;
            text-align: center;
        }

        /* ===== PRINT MEDIA ===== */
        @media print {
            body {
                background-color: #ffffff;
                padding: 0;
            }
            .invoice-container {
                box-shadow: none;
                width: 100%;
                max-width: 100%;
            }
            .card {
                box-shadow: none;
                border: none;
                padding: 0;
            }
            .btn-container {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    @php
        $company = \App\Models\CompanySetting::first() ?? \App\Models\CompanyProfile::first();
        $companyName = $company->company_name ?? $company->name ?? 'PT PROPERTI MANAGEMENT';
        $companyAddress = $company->address ?? 'Jl. Sudirman No. 123';
        if (!empty($company->city)) {
            $companyAddress .= ', ' . $company->city;
        }
        if (!empty($company->province)) {
            $companyAddress .= ', ' . $company->province;
        }
        $companyPhone = $company->phone ?? $company->whatsapp ?? '(021) 1234-5678';
        $companyEmail = $company->email ?? 'finance@propertimanagement.com';
        $companyNpwp = $company->npwp ?? '01.234.567.8-999.000';

        $dealPrice = (float)($land->deal_price ?? $land->estimated_price ?? $land->offer_price ?? 0);
        $costIjb = (float)($land->cost_ijb ?? 0);
        $costTax = (float)($land->cost_tax ?? 0);
        $costBroker = (float)($land->cost_broker ?? 0);
        $costOther = (float)($land->cost_other ?? 0);
        $grandTotal = $dealPrice + $costIjb + $costTax + $costBroker + $costOther;

        $method = $land->payment_method ?? 'cash';
        $payments = $land->payments ?? collect([]);

        // Terbilang function
        function penyebut($nilai) {
            $nilai = abs($nilai);
            $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
            $temp = "";
            if ($nilai < 12) {
                $temp = " ". $huruf[(int)$nilai];
            } else if ($nilai < 20) {
                $temp = penyebut($nilai - 10). " Belas";
            } else if ($nilai < 100) {
                $temp = penyebut((int)($nilai / 10))." Puluh". penyebut($nilai % 10);
            } else if ($nilai < 200) {
                $temp = " Seratus" . penyebut($nilai - 100);
            } else if ($nilai < 1000) {
                $temp = penyebut((int)($nilai / 100)) . " Ratus" . penyebut($nilai % 100);
            } else if ($nilai < 2000) {
                $temp = " Seribu" . penyebut($nilai - 1000);
            } else if ($nilai < 1000000) {
                $temp = penyebut((int)($nilai / 1000)) . " Ribu" . penyebut($nilai % 1000);
            } else if ($nilai < 1000000000) {
                $temp = penyebut((int)($nilai / 1000000)) . " Juta" . penyebut(fmod($nilai, 1000000));
            } else if ($nilai < 1000000000000) {
                $temp = penyebut((int)($nilai / 1000000000)) . " Milyar" . penyebut(fmod($nilai, 1000000000));
            } else if ($nilai < 1000000000000000) {
                $temp = penyebut((int)($nilai / 1000000000000)) . " Trilyun" . penyebut(fmod($nilai, 1000000000000));
            }
            return $temp;
        }

        function terbilangRupiah($nilai) {
            if($nilai < 0) {
                return "Minus ". trim(penyebut($nilai)) . " Rupiah";
            } else if($nilai == 0) {
                return "Nol Rupiah";
            } else {
                return trim(penyebut($nilai)) . " Rupiah";
            }
        }
    @endphp

    <div class="invoice-container">

        <!-- TOMBOL AKSI ATAS -->
        <div class="btn-container">
            <a href="{{ route('pra-landbank.proses', $land->id) }}?step=3" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Kembali ke Form Fase 3
            </a>
            <div style="display: flex; gap: 8px;">
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    <i class="mdi mdi-printer"></i> Cetak / Simpan PDF
                </button>
            </div>
        </div>

        <!-- CARD INVOICE UTAMA -->
        <div class="card">

            <!-- KOP PERUSAHAAN (DINAMIS DARI COMPANY SETTINGS) -->
            <div class="company-header">
                <div class="company-info">
                    <h2>{{ $companyName }}</h2>
                    <p>Divisi Land Banking & Akuisisi Lahan Properti</p>
                    <p>{{ $companyAddress }}</p>
                    <p>Telp: {{ $companyPhone }} | Email: {{ $companyEmail }} | NPWP: {{ $companyNpwp }}</p>
                </div>
                <div class="invoice-badge-title">
                    <h1>INVOICE</h1>
                    <span>{{ $invoiceNumber }}</span>
                </div>
            </div>

            <!-- GRID INFO TRANSAKSI & OBJEK LAHAN -->
            <div class="meta-grid">
                <!-- Data Objek Tanah -->
                <div class="meta-box">
                    <h5><i class="mdi mdi-map-marker-radius"></i> Informasi Objek Lahan</h5>
                    <table class="meta-table">
                        <tr>
                            <td>Nama Prospek</td>
                            <td>:</td>
                            <td>{{ $land->land_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td>:</td>
                            <td>{{ $land->address ? $land->address . ', ' : '' }}{{ $land->village ? 'Desa ' . $land->village . ', ' : '' }}{{ $land->district ? 'Kec. ' . $land->district . ', ' : '' }}{{ $land->city ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Luas Tanah</td>
                            <td>:</td>
                            <td>{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</td>
                        </tr>
                        <tr>
                            <td>Status Hak</td>
                            <td>:</td>
                            <td>{{ $land->ownership_status ?? 'SHM' }} (Zonasi: {{ $land->zoning ?? '-' }})</td>
                        </tr>
                    </table>
                </div>

                <!-- Data Pemilik & Transaksi -->
                @php
                    $cashPayment = ($method === 'cash') ? $payments->first() : null;
                @endphp
                <div class="meta-box">
                    <h5><i class="mdi mdi-account-tie"></i> Data Pihak & Transaksi</h5>
                    <table class="meta-table">
                        <tr>
                            <td>Pemilik Tanah</td>
                            <td>:</td>
                            <td>{{ $land->owner_name ?? $land->certificate_owner ?? $land->land_owner ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Sertifikat a/n</td>
                            <td>:</td>
                            <td>{{ $land->certificate_owner ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Invoice</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Metode Bayar</td>
                            <td>:</td>
                            <td>
                                @if($method === 'cash')
                                    <span style="color: #16a34a; font-weight: bold;">Cash Keras (Lunas Sekaligus)</span>
                                    @if($cashPayment && $cashPayment->payment_type === 'transfer')
                                        <div style="font-size: 11px; color: #475569; font-weight: normal; margin-top: 2px;">
                                            Transfer: <strong>{{ $cashPayment->bank_name ?? 'Bank' }}</strong> No. Rek: <strong>{{ $cashPayment->account_number ?? '-' }}</strong> (a/n {{ $cashPayment->account_name ?? '-' }})
                                        </div>
                                    @elseif($cashPayment && $cashPayment->payment_type === 'cash')
                                        <div style="font-size: 11px; color: #475569; font-weight: normal; margin-top: 2px;">
                                            Saluran: <strong>Tunai / Cash Langsung</strong>
                                        </div>
                                    @endif
                                @else
                                    <span style="color: #2563eb; font-weight: bold;">Pembayaran Bertahap (Termin {{ $land->installment_count ?? count($payments) }}x)</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- TABEL RINCIAN BIAYA & KOMPONEN DINAMIS -->
            <div class="table-title">
                <i class="mdi mdi-format-list-numbered"></i> Rincian Akumulasi Biaya Transaksi & Pengadaan Lahan
            </div>
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="8%" class="text-center">No</th>
                        <th width="62%">Deskripsi Komponen Transaksi</th>
                        <th width="30%" class="text-end">Nominal (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td><strong>Harga Kesepakatan Deal Pokok Tanah</strong> ({{ number_format($land->area ?? 0, 0, ',', '.') }} m²)</td>
                        <td class="text-end fw-bold">Rp {{ number_format($dealPrice, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Biaya Pembuatan Akta Notaris (IJB / PPJB / AJB)</td>
                        <td class="text-end">Rp {{ number_format($costIjb, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Estimasi Pajak Transaksi (PPh Penjual & BPHTB Pembeli)</td>
                        <td class="text-end">Rp {{ number_format($costTax, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>Fee Makelar / Perantara Transaksi</td>
                        <td class="text-end">Rp {{ number_format($costBroker, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td>Biaya Administrasi & Operasional Lain-lain</td>
                        <td class="text-end">Rp {{ number_format($costOther, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="grand-total-row">
                        <td colspan="2" class="text-end">TOTAL KESELURUHAN PENGADAAN (GRAND TOTAL)</td>
                        <td class="text-end">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- TERBILANG -->
            <div class="terbilang-box">
                <strong>Terbilang:</strong> {{ terbilangRupiah($grandTotal) }}
            </div>

            <!-- SKEMA PEMBAYARAN JIKA TERMIN -->
            @if($method === 'termin' && $payments->count() > 0)
                <div class="table-title">
                    <i class="mdi mdi-calendar-clock"></i> Jadwal & Rincian Realisasi Pembayaran Bertahap (Termin)
                </div>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th width="20%">Tahap Pembayaran</th>
                            <th width="25%">Saluran / Rekening</th>
                            <th width="20%">Jatuh Tempo</th>
                            <th width="15%" class="text-center">Status</th>
                            <th width="20%" class="text-end">Nominal (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $pmt)
                            <tr>
                                <td class="fw-bold">{{ $pmt->term_name }}</td>
                                <td>
                                    @if($pmt->payment_type === 'cash')
                                        <span style="background: #f1f5f9; color: #475569; padding: 2px 6px; border-radius: 4px; font-size: 11px; font-weight: bold;">Tunai / Cash</span>
                                    @else
                                        <span style="font-weight: 600; color: #1e293b;">{{ $pmt->bank_name ?? 'Transfer Bank' }}</span>
                                        @if($pmt->account_number)
                                            <br><small style="color: #64748b; font-size: 11px;">Rek: {{ $pmt->account_number }}</small>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $pmt->due_date ? \Carbon\Carbon::parse($pmt->due_date)->translatedFormat('d F Y') : '-' }}</td>
                                <td class="text-center">
                                    <span style="font-weight: bold; padding: 2px 6px; border-radius: 4px; font-size: 11px; {{ $pmt->status == 'lunas' ? 'background: #dcfce7; color: #15803d;' : 'background: #fef9c3; color: #a16207;' }}">
                                        {{ strtoupper($pmt->status) }}
                                    </span>
                                </td>
                                <td class="text-end fw-bold">Rp {{ number_format($pmt->amount, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif($method === 'cash')
                <div class="table-title">
                    <i class="mdi mdi-cash-check"></i> Status Realisasi Pembayaran Cash Keras
                </div>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th width="25%">Skema Realisasi</th>
                            <th width="25%">Saluran / Rekening</th>
                            <th width="18%">Tanggal Realisasi</th>
                            <th width="12%" class="text-center">Status</th>
                            <th width="20%" class="text-end">Nominal (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Pelunasan Sekaligus 100%</td>
                            <td>
                                @if($cashPayment && $cashPayment->payment_type === 'transfer')
                                    <strong>{{ $cashPayment->bank_name ?? 'Bank Transfer' }}</strong><br>
                                    <span style="font-size: 11px; color: #475569;">No: {{ $cashPayment->account_number ?? '-' }}</span><br>
                                    <span style="font-size: 11px; color: #475569;">a/n {{ $cashPayment->account_name ?? '-' }}</span>
                                @else
                                    <span style="background: #f1f5f9; color: #475569; padding: 2px 6px; border-radius: 4px; font-size: 11px; font-weight: bold;">Tunai / Cash Langsung</span>
                                @endif
                            </td>
                            <td>{{ $cashPayment && $cashPayment->due_date ? \Carbon\Carbon::parse($cashPayment->due_date)->translatedFormat('d F Y') : \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
                            <td class="text-center">
                                <span style="font-weight: bold; padding: 2px 6px; border-radius: 4px; font-size: 11px; background: #dcfce7; color: #15803d;">
                                    {{ strtoupper($cashPayment->status ?? 'LUNAS') }}
                                </span>
                            </td>
                            <td class="text-end fw-bold">Rp {{ number_format($cashPayment ? $cashPayment->amount : $grandTotal, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <!-- DOKUMEN MASTER LEGALITAS & PERIZINAN TERPADU (LAMPIRAN DOKUMEN DINAMIS) -->
            @php
                $docs = $land->documents ?? collect([]);
            @endphp
            @if($docs->count() > 0)
                <div class="table-title" style="margin-top: 18px;">
                    <i class="mdi mdi-file-document-check-outline"></i> Lampiran Berkas Dokumen & Legalitas Terverifikasi
                </div>
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th width="8%" class="text-center">No</th>
                            <th width="42%">Nama Dokumen / Berkas Persyaratan</th>
                            <th width="30%">Status Verifikasi Berkas</th>
                            <th width="20%">Tanggal Unggah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($docs as $dIndex => $docItem)
                            <tr>
                                <td class="text-center">{{ $dIndex + 1 }}</td>
                                <td class="fw-bold">{{ $docItem->documentType->name ?? 'Dokumen Legalitas' }}</td>
                                <td>
                                    @if($docItem->file_path)
                                        <span style="color: #15803d; font-weight: 600;">
                                            <i class="mdi mdi-check-circle"></i> Berkas Terlampir ({{ basename($docItem->file_path) }})
                                        </span>
                                    @else
                                        <span style="color: #94a3b8; font-style: italic;">Belum Diunggah</span>
                                    @endif
                                </td>
                                <td>{{ $docItem->updated_at ? $docItem->updated_at->translatedFormat('d F Y') : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <!-- LEMBAR PENGESAHAN / TANDA TANGAN -->
            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-role">Pihak Penjual / Pemilik Lahan,</div>
                    <div class="signature-name">{{ $land->owner_name ?? $land->certificate_owner ?? $land->land_owner ?? '(..........................................)' }}</div>
                    <div class="signature-note">Pemilik / Kuasa Jual</div>
                </div>

                <div class="signature-box">
                    <div class="signature-role">Mengetahui / Notaris Rekanan,</div>
                    <div class="signature-name">(..........................................)</div>
                    <div class="signature-note">PPAT / Notaris</div>
                </div>

                <div class="signature-box">
                    <div class="signature-role">Pihak Pembeli (Manajemen),</div>
                    <div class="signature-name">{{ auth()->user()->name ?? 'Direktur Utama' }}</div>
                    <div class="signature-note">{{ $companyName }}</div>
                </div>
            </div>

            <!-- CATATAN KAKI -->
            <div class="footer-note">
                Invoice ini merupakan bukti sah transaksi pengadaan lahan pada sistem {{ $companyName }}. Dicetak otomatis pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }} WIB.
            </div>

        </div>
    </div>

</body>
</html>
