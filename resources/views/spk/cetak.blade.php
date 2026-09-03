<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perintah Kerja (SPK) - {{ $spk->no_spk }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS & Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Times New Roman', Times, Georgia, serif;
            color: #0f172a;
            font-size: 11pt;
            line-height: 1.5;
            margin: 0;
            padding: 20px 0;
        }

        /* Floating Top Action Bar (Screen Only) */
        .no-print-bar {
            position: fixed;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            background: rgba(15, 23, 42, 0.92);
            backdrop-filter: blur(8px);
            padding: 8px 18px;
            border-radius: 50px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25);
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .no-print-bar .btn-action-print {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: #ffffff;
            border: none;
            padding: 7px 18px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .no-print-bar .btn-action-print:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
            color: #ffffff;
        }

        .no-print-bar .btn-action-close {
            background: rgba(255, 255, 255, 0.15);
            color: #f8fafc;
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 7px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .no-print-bar .btn-action-close:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
        }

        /* Printable Paper Container */
        .print-container {
            width: 210mm;
            min-height: 297mm;
            padding: 18mm 20mm 20mm 20mm;
            margin: 50px auto 30px auto;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        /* Official Kop Surat (Tanpa Logo - Rata Tengah) */
        .kop-surat-box {
            text-align: center;
            margin-bottom: 6px;
        }

        .kop-company-title {
            font-family: 'Times New Roman', serif;
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #000000;
            margin: 0 0 4px 0;
            line-height: 1.2;
        }

        .kop-company-desc {
            font-family: 'Times New Roman', serif;
            font-size: 10pt;
            color: #1e293b;
            margin: 0;
            line-height: 1.35;
        }

        .kop-divider {
            border-top: 3px solid #000000;
            border-bottom: 1px solid #000000;
            height: 4px;
            margin-top: 8px;
            margin-bottom: 20px;
        }

        /* Judul Surat */
        .judul-surat-box {
            text-align: center;
            margin-bottom: 18px;
        }

        .judul-surat-title {
            font-size: 13.5pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 3px;
        }

        .judul-surat-nomor {
            font-size: 10.5pt;
            font-weight: bold;
            color: #000000;
            margin-bottom: 0;
        }

        /* Paragraphs & Text */
        p.spk-text {
            text-align: justify;
            text-indent: 0;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        /* Identitas Para Pihak */
        .pihak-box {
            margin-bottom: 12px;
        }

        .table-pihak {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .table-pihak td {
            padding: 2.5px 4px;
            vertical-align: top;
            font-size: 10.5pt;
            line-height: 1.4;
        }

        /* Pasal Header */
        .pasal-heading {
            font-size: 11pt;
            font-weight: bold;
            text-align: center;
            margin-top: 14px;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* Ordered List Pasal */
        ol.pasal-list {
            margin-top: 2px;
            margin-bottom: 8px;
            padding-left: 22px;
            text-align: justify;
        }

        ol.pasal-list li {
            margin-bottom: 4px;
            line-height: 1.45;
            font-size: 10.5pt;
        }

        /* Termin Table */
        .table-termin-cetak {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0 14px 0;
            font-size: 9.5pt;
        }

        .table-termin-cetak th, 
        .table-termin-cetak td {
            border: 1px solid #000000;
            padding: 5px 7px;
            line-height: 1.35;
        }

        .table-termin-cetak thead th {
            background-color: #f1f5f9 !important;
            color: #000000;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .table-termin-cetak tfoot td {
            font-weight: bold;
            background-color: #f8fafc !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Klausul Tambahan */
        .klausul-tambahan-text {
            font-size: 10.5pt;
            text-align: justify;
            line-height: 1.55;
            white-space: pre-line;
            margin-top: 8px;
            margin-bottom: 12px;
        }

        /* Signatures Box */
        .signature-section {
            margin-top: 28px;
            page-break-inside: avoid;
        }

        .signature-col {
            text-align: center;
            vertical-align: top;
        }

        .materai-placeholder {
            width: 85px;
            height: 50px;
            border: 1px dashed #94a3b8;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 7.5pt;
            color: #64748b;
            margin: 8px auto;
            text-align: center;
            line-height: 1.2;
        }

        .sign-space {
            height: 65px;
        }

        .sign-name {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 1px;
            font-size: 10.5pt;
        }

        .sign-title {
            font-size: 9.5pt;
            color: #334155;
            margin: 0;
        }

        /* Print Specific Media Queries */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
                color: #000000 !important;
            }

            .no-print-bar {
                display: none !important;
            }

            .print-container {
                width: 100% !important;
                min-height: auto !important;
                padding: 0 !important;
                margin: 0 !important;
                box-shadow: none !important;
            }

            .kop-divider {
                border-top: 3px solid #000000 !important;
                border-bottom: 1px solid #000000 !important;
            }

            .table-termin-cetak thead th {
                background-color: #f1f5f9 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .signature-section {
                page-break-inside: avoid !important;
            }

            @page {
                size: A4 portrait;
                margin: 15mm 15mm 15mm 15mm;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Action Toolbar (Screen Only) -->
    <div class="no-print-bar">
        <a href="{{ route('spk.show', $spk->id) }}" class="btn-action-close" title="Kembali ke Detail SPK">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
        <button type="button" class="btn-action-print" onclick="window.print()" title="Cetak Surat atau Simpan PDF">
            <i class="mdi mdi-printer"></i> Cetak / Simpan PDF
        </button>
    </div>

    <!-- Paper Container -->
    <div class="print-container">
        
        <!-- ================= KOP SURAT (RESMI TANPA LOGO) ================= -->
        <div class="kop-surat-box">
            <h2 class="kop-company-title">
                {{ $spk->pihak_pertama_perusahaan ?: ($companySetting->company_name ?? ($companyProfile->name ?? 'PT. DEVELOPER PROPERTI INDONESIA')) }}
            </h2>
            <p class="kop-company-desc">
                {{ $companySetting->address ?? ($companyProfile->address ?? 'Jl. Raya Utama Kawasan Perumahan') }}
                @if($companySetting && $companySetting->city), {{ $companySetting->city }}@endif
                <br>
                Telp: {{ $companySetting->phone ?? ($companyProfile->phone ?? '-') }} | Email: {{ $companySetting->email ?? 'info@developer.com' }}
            </p>
        </div>
        <div class="kop-divider"></div>

        <!-- ================= JUDUL SURAT ================= -->
        <div class="judul-surat-box">
            <div class="judul-surat-title">SURAT PERINTAH KERJA (SPK)</div>
            <div class="judul-surat-nomor">Nomor : {{ $spk->no_spk }}</div>
        </div>

        <!-- ================= PEMBUKAAN ================= -->
        <p class="spk-text">
            Pada hari ini, <strong>{{ \Carbon\Carbon::parse($spk->tanggal_spk)->isoFormat('dddd') }}</strong>, tanggal <strong>{{ \Carbon\Carbon::parse($spk->tanggal_spk)->isoFormat('D MMMM Y') }}</strong> ({{ \Carbon\Carbon::parse($spk->tanggal_spk)->format('d/m/Y') }}), bertempat di kantor <strong>{{ $spk->pihak_pertama_perusahaan ?: ($companySetting->company_name ?? 'Developer') }}</strong>, telah dibuat dan disepakati Surat Perintah Kerja oleh dan antara pihak-pihak di bawah ini:
        </p>

        <!-- ================= IDENTITAS PARA PIHAK ================= -->
        <div class="pihak-box">
            <table class="table-pihak">
                <tr>
                    <td style="width: 25px; font-weight: bold;">I.</td>
                    <td style="width: 145px;">Nama Perusahaan</td>
                    <td style="width: 15px;">:</td>
                    <td><strong>{{ $spk->pihak_pertama_perusahaan ?: ($companySetting->company_name ?? 'Developer') }}</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nama Perwakilan</td>
                    <td>:</td>
                    <td><strong>{{ $spk->pihak_pertama_nama ?: 'Direktur Utama' }}</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{ $spk->pihak_pertama_jabatan ?: 'Direktur Utama / Project Manager' }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $spk->pihak_pertama_alamat ?: ($companySetting->address ?? '-') }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>No. Telepon / HP</td>
                    <td>:</td>
                    <td>{{ $spk->pihak_pertama_telepon ?: '-' }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" style="padding-top: 2px; padding-bottom: 6px;">
                        Bertindak untuk dan atas nama <strong>{{ $spk->pihak_pertama_perusahaan ?: ($companySetting->company_name ?? 'Developer') }}</strong>, selanjutnya dalam perjanjian ini disebut sebagai <strong>PIHAK PERTAMA (Pemberi Tugas)</strong>.
                    </td>
                </tr>

                <tr>
                    <td style="font-weight: bold; padding-top: 6px;">II.</td>
                    <td style="padding-top: 6px;">Nama Kontraktor/Usaha</td>
                    <td style="padding-top: 6px;">:</td>
                    <td style="padding-top: 6px;"><strong>{{ $spk->kontraktor_nama }}</strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Penanggung Jawab (PIC)</td>
                    <td>:</td>
                    <td><strong>{{ $spk->kontraktor_pic ?: '-' }}</strong> @if($spk->kontraktor_ktp) (NIK: {{ $spk->kontraktor_ktp }}) @endif</td>
                </tr>
                <tr>
                    <td></td>
                    <td>No. Telepon / WhatsApp</td>
                    <td>:</td>
                    <td>{{ $spk->kontraktor_telepon ?: '-' }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat Kontraktor</td>
                    <td>:</td>
                    <td>{{ $spk->kontraktor_alamat ?: '-' }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Rekening Pembayaran</td>
                    <td>:</td>
                    <td>Bank {{ $spk->kontraktor_bank ?: '-' }} - No. {{ $spk->kontraktor_rekening ?: '-' }} (a.n {{ $spk->kontraktor_atas_nama ?: $spk->kontraktor_nama }})</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" style="padding-top: 2px;">
                        Bertindak untuk dan atas nama kontraktor / pelaksana pekerjaan, selanjutnya dalam perjanjian ini disebut sebagai <strong>PIHAK KEDUA (Penerima Tugas)</strong>.
                    </td>
                </tr>
            </table>
        </div>

        <p class="spk-text" style="margin-bottom: 8px;">
            Kedua belah pihak telah sepakat untuk mengikatkan diri dalam ikatan kerja pelaksanaan pekerjaan dengan syarat-syarat dan ketentuan yang diatur dalam pasal-pasal berikut:
        </p>

        <!-- ================= PASAL 1 ================= -->
        <div class="pasal-heading">PASAL 1 : LINGKUP & LOKASI PEKERJAAN</div>
        <ol class="pasal-list">
            <li>PIHAK PERTAMA memberikan tugas kepada PIHAK KEDUA dan PIHAK KEDUA menerima penugasan tersebut untuk melaksanakan pekerjaan: <strong>{{ $spk->nama_pekerjaan }}</strong>.</li>
            <li>Lokasi pekerjaan terletak pada proyek <strong>{{ $spk->landBank->name ?? '-' }}</strong> @if($spk->unit) pada <strong>Kavling {{ $spk->unit->unit_code }}</strong> (Tipe {{ $spk->unit->type }}, LT: {{ $spk->unit->area }} m², LB: {{ $spk->unit->building_area }} m²)@endif.</li>
            @if($spk->deskripsi_pekerjaan)
                <li>Rincian teknis pelaksanaan pekerjaan: {{ $spk->deskripsi_pekerjaan }}.</li>
            @endif
        </ol>

        <!-- ================= PASAL 2 ================= -->
        <div class="pasal-heading">PASAL 2 : NILAI KONTRAK PEKERJAAN</div>
        <ol class="pasal-list">
            <li>Total biaya pelaksanaan pekerjaan yang disepakati adalah sebesar <strong>{{ $spk->formatted_nilai_kontrak }}</strong> (<em>{{ $spk->terbilang }}</em>).</li>
            <li>Nilai kontrak tersebut bersifat borongan (<em>fixed price</em>) dan sudah mencakup seluruh upah tenaga kerja, pengadaan material (apabila borong material), peralatan kerja, dan biaya operasional di lapangan.</li>
        </ol>

        <!-- ================= PASAL 3 ================= -->
        <div class="pasal-heading">PASAL 3 : JANGKA WAKTU PELAKSANAAN</div>
        <ol class="pasal-list">
            <li>Jangka waktu pelaksanaan pekerjaan ditetapkan selama <strong>{{ $spk->durasi_hari }} ({{ \App\Models\Spk::penyebut($spk->durasi_hari) }}) hari kalender</strong>.</li>
            <li>Pekerjaan dimulai pada tanggal <strong>{{ \Carbon\Carbon::parse($spk->tanggal_mulai)->isoFormat('D MMMM Y') }}</strong> dan harus diserahterimakan dalam keadaan selesai 100% selambat-lambatnya pada tanggal <strong>{{ \Carbon\Carbon::parse($spk->tanggal_selesai)->isoFormat('D MMMM Y') }}</strong>.</li>
        </ol>

        <!-- ================= PASAL 4 ================= -->
        <div class="pasal-heading">PASAL 4 : TAHAPAN & TERMIN PEMBAYARAN</div>
        <p class="spk-text" style="margin-bottom: 4px;">
            Pembayaran oleh PIHAK PERTAMA kepada PIHAK KEDUA dilakukan secara bertahap (termin) sesuai dengan prestasi fisik pekerjaan di lapangan:
        </p>
        
        <table class="table-termin-cetak">
            <thead>
                <tr>
                    <th style="width: 35px;">No</th>
                    <th>Tahap / Uraian Termin</th>
                    <th style="width: 85px;">Syarat Fisik</th>
                    <th style="width: 70px;">Bobot</th>
                    <th style="width: 130px;">Nominal (Rp)</th>
                    <th style="width: 120px;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spk->termins as $idx => $t)
                    <tr>
                        <td class="text-center">{{ $idx + 1 }}</td>
                        <td><strong>{{ $t->nama_tahap }}</strong></td>
                        <td class="text-center">{{ $t->syarat_progress }}%</td>
                        <td class="text-center">{{ $t->persentase }}%</td>
                        <td class="text-end fw-bold">{{ $t->formatted_nominal }}</td>
                        <td>{{ $t->keterangan ?: ($t->tanggal_jatuh_tempo ? 'Jatuh tempo: ' . date('d/m/Y', strtotime($t->tanggal_jatuh_tempo)) : '-') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Pembayaran penuh 100% setelah seluruh pekerjaan diserahterimakan.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end">TOTAL NILAI KONTRAK</td>
                    <td class="text-center">{{ $spk->termins->sum('persentase') }}%</td>
                    <td class="text-end">{{ $spk->formatted_nilai_kontrak }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <!-- ================= PASAL SYARAT KETENTUAN (PASAL 5 DST) ================= -->
        @if($spk->pasal_syarat_ketentuan)
            <div class="klausul-tambahan-text">
                @php
                    $pasalContent = $spk->pasal_syarat_ketentuan;
                    // Jika teks berisi pasal 1-4 lama yang duplikat, potong mulai dari PASAL 5
                    if (str_contains($pasalContent, 'PASAL 5:')) {
                        $pos = strpos($pasalContent, 'PASAL 5:');
                        if ($pos > 0 && (str_contains($pasalContent, 'PASAL 1:') || str_contains($pasalContent, 'PASAL 1 :') || str_contains($pasalContent, 'PASAL 1 '))) {
                            $pasalContent = substr($pasalContent, $pos);
                        }
                    }
                @endphp
                @if(strip_tags($pasalContent) == $pasalContent)
                    {!! nl2br(e($pasalContent)) !!}
                @else
                    {!! $pasalContent !!}
                @endif
            </div>
        @endif

        @if($spk->keterangan)
            <div class="p-2 mb-2 border rounded" style="background-color: #f8fafc; font-size: 10pt;">
                <strong>Catatan Tambahan:</strong> {{ $spk->keterangan }}
            </div>
        @endif

        <!-- ================= PENUTUP ================= -->
        <p class="spk-text" style="margin-top: 14px; margin-bottom: 18px;">
            Demikian Surat Perintah Kerja (SPK) ini dibuat dalam rangkap 2 (dua) bermaterai cukup dan masing-masing pihak memegang 1 (satu) rangkap asli yang memiliki kekuatan hukum yang sama dan berlaku sejak tanggal ditandatangani.
        </p>

        <!-- ================= KOLOM TANDA TANGAN ================= -->
        <div class="signature-section">
            <table style="width: 100%;">
                <tr>
                    <td class="signature-col" style="width: 48%;">
                        <div class="fw-bold">PIHAK KEDUA</div>
                        <div class="text-muted" style="font-size: 9.5pt;">{{ $spk->kontraktor_nama }}</div>
                        <div class="materai-placeholder">
                            Materai<br>Rp 10.000
                        </div>
                        <div class="sign-space" style="height: 25px;"></div>
                        <div class="sign-name">( {{ $spk->kontraktor_pic ?: $spk->kontraktor_nama }} )</div>
                        <div class="sign-title">Kontraktor / Pelaksana Pekerjaan</div>
                    </td>

                    <td style="width: 4%;"></td>

                    <td class="signature-col" style="width: 48%;">
                        <div class="fw-bold">PIHAK PERTAMA</div>
                        <div class="text-muted" style="font-size: 9.5pt;">{{ $spk->pihak_pertama_perusahaan ?: ($companySetting->company_name ?? 'Developer') }}</div>
                        <div class="sign-space" style="height: 83px;"></div>
                        <div class="sign-name">( {{ $spk->pihak_pertama_nama ?: 'Direktur Utama' }} )</div>
                        <div class="sign-title">{{ $spk->pihak_pertama_jabatan ?: 'Pemberi Tugas' }}</div>
                    </td>
                </tr>
            </table>
        </div>

    </div>

</body>
</html>
