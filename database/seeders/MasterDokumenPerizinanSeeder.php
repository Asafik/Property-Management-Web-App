<?php

namespace Database\Seeders;

use App\Models\MasterDokumenPerizinan;
use Illuminate\Database\Seeder;

class MasterDokumenPerizinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permits = [
            // POIN 7: KELURAHAN & KECAMATAN
            [
                'kode_dokumen'     => 'POIN-07',
                'nama_dokumen'     => 'Penandatanganan Blangko Permohonan Kelurahan & Kecamatan Setempat',
                'kategori'         => 'Desa & Kecamatan',
                'instansi_terkait' => 'Pihak Kelurahan dan Kantor Kecamatan Setempat',
                'estimasi_hari'    => 5,
                'estimasi_biaya'   => 0,
                'syarat_dokumen'   => "• Upload Salinan Akta Pelepasan Hak dari Notaris\n• Copy Salinan akta pelepasan\n• Berkas kepemilikan tanah yang sudah lengkap\n• Legalitas PT",
                'deskripsi'        => 'Tahapan registrasi dan penandatanganan blangko permohonan pengalihan/pengindukan tanah kepada pihak kelurahan dan kecamatan setempat pasca pelepasan hak di notaris.',
                'urutan'           => 7,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 8: PERTEK ATR/BPN
            [
                'kode_dokumen'     => 'POIN-08',
                'nama_dokumen'     => 'Proses Pertimbangan Teknis Pertanahan (PERTEK)',
                'kategori'         => 'Pertanahan & BPN',
                'instansi_terkait' => 'Kantor Pertanahan (ATR/BPN) Kab/Kota',
                'estimasi_hari'    => 14,
                'estimasi_biaya'   => 2500000,
                'syarat_dokumen'   => "• Copy Salinan akta pelepasan\n• Berkas kepemilikan tanah yang sudah lengkap\n• Legalitas PT",
                'deskripsi'        => 'Kajian teknis tata ruang, kemampuan dan penguasaan tanah oleh Kantor ATR/BPN sebagai syarat dasar kesesuaian ruang perumahan.',
                'urutan'           => 8,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 9: PETA BIDANG & PENGUKURAN
            [
                'kode_dokumen'     => 'POIN-09',
                'nama_dokumen'     => 'Proses Peta Bidang dan Pengukuran Tanah',
                'kategori'         => 'Pertanahan & BPN',
                'instansi_terkait' => 'Seksi Survei & Pemetaan Kantor Pertanahan (ATR/BPN)',
                'estimasi_hari'    => 14,
                'estimasi_biaya'   => 3500000,
                'syarat_dokumen'   => "• Copy Salinan akta pelepasan\n• Berkas kepemilikan tanah yang sudah lengkap\n• Legalitas PT",
                'deskripsi'        => 'Pengukuran kadastral batas keliling fisik tanah untuk penerbitan Peta Bidang dan penetapan Nomor Identifikasi Bidang (NIB) oleh BPN.',
                'urutan'           => 9,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 10: PKKPR DINAS PTSP & PU
            [
                'kode_dokumen'     => 'POIN-10',
                'nama_dokumen'     => 'Proses PKKPR (Dinas PTSP dan Dinas PU Tata Ruang)',
                'kategori'         => 'Kementerian & OSS RBA',
                'instansi_terkait' => 'Dinas Penanaman Modal PTSP & Dinas PU Tata Ruang / OSS-RBA',
                'estimasi_hari'    => 20,
                'estimasi_biaya'   => 0,
                'syarat_dokumen'   => "• Input pada system OSS RBA\n• Legalitas PT\n• Sket gambar tanah\n• Polygon / SHP\n• Pertek BPN\n• Peta Bidang BPN",
                'deskripsi'        => 'Penerbitan Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang (PKKPR) pada portal OSS RBA berkoordinasi dengan Dinas PU Tata Ruang dan DPMPTSP.',
                'urutan'           => 10,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 11: PERMOHONAN HGB BADAN HUKUM
            [
                'kode_dokumen'     => 'POIN-11',
                'nama_dokumen'     => 'Permohonan Hak Guna Bangunan (HGB) Badan Hukum (Pengindukan Sertipikat)',
                'kategori'         => 'Pertanahan & BPN',
                'instansi_terkait' => 'Kantor Pertanahan (ATR/BPN) / Kanwil BPN',
                'estimasi_hari'    => 21,
                'estimasi_biaya'   => 5000000,
                'syarat_dokumen'   => "• Legalitas PT\n• PKKPR\n• PERTEK\n• PETA BIDANG",
                'deskripsi'        => 'Pengajuan permohonan pemberian hak atas tanah negara/bekas hak milik menjadi Hak Guna Bangunan atas nama Badan Hukum PT Developer.',
                'urutan'           => 11,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 12: SK HGB DARI BPN
            [
                'kode_dokumen'     => 'POIN-12',
                'nama_dokumen'     => 'SK HGB Keluar dari BPN',
                'kategori'         => 'Pertanahan & BPN',
                'instansi_terkait' => 'Kantor Pertanahan (ATR/BPN)',
                'estimasi_hari'    => 14,
                'estimasi_biaya'   => 0,
                'syarat_dokumen'   => "• Asli Salinan Akta Pelepasan\n• Berkas kepemilikan tanah yang sudah lengkap\n• Bukti Pembayaran PPH",
                'deskripsi'        => 'Penerbitan Surat Keputusan (SK) resmi Pemberian Hak Guna Bangunan atas nama PT dari Kepala Kantor Pertanahan / Kakanwil BPN.',
                'urutan'           => 12,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 13: MUTASI PAJAK PBB
            [
                'kode_dokumen'     => 'POIN-13',
                'nama_dokumen'     => 'Mutasi Pajak PBB pada Kantor BAPENDA',
                'kategori'         => 'Perpajakan & Bapenda',
                'instansi_terkait' => 'Badan Pendapatan Daerah (BAPENDA) Kab/Kota',
                'estimasi_hari'    => 10,
                'estimasi_biaya'   => 0,
                'syarat_dokumen'   => "• SPPT PBB th berjalan\n• Copy SK HGB dari BPN",
                'deskripsi'        => 'Proses mutasi data subjek dan objek pajak bumi dan bangunan (PBB) dari nama pemilik awal menjadi atas nama PT developer.',
                'urutan'           => 13,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 14: PEMBAYARAN PAJAK BPHTB
            [
                'kode_dokumen'     => 'POIN-14',
                'nama_dokumen'     => 'Pajak PBB Selesai Proses Mutasi, Pembayaran Pajak BPHTB',
                'kategori'         => 'Perpajakan & Bapenda',
                'instansi_terkait' => 'Kantor BAPENDA / Bank Persepsi Daerah',
                'estimasi_hari'    => 3,
                'estimasi_biaya'   => 0,
                'syarat_dokumen'   => "• PBB yang sudah Mutasi\n• Pengajuan yang sudah di ACC oleh Direktur PT",
                'deskripsi'        => 'Penghitungan dan pembayaran kewajiban Bea Perolehan Hak atas Tanah dan Bangunan (BPHTB) setelah terbitnya ketetapan SPPT PBB mutasi.',
                'urutan'           => 14,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 15: VALIDASI BPHTB
            [
                'kode_dokumen'     => 'POIN-15',
                'nama_dokumen'     => 'Validasi BPHTB BAPENDA',
                'kategori'         => 'Perpajakan & Bapenda',
                'instansi_terkait' => 'Badan Pendapatan Daerah (BAPENDA)',
                'estimasi_hari'    => 5,
                'estimasi_biaya'   => 0,
                'syarat_dokumen'   => "• Bukti pembayaran BPHTB\n• Id Billing",
                'deskripsi'        => 'Pengesahan dan verifikasi SSPD BPHTB dari Bapenda sebagai bukti lunas pajak perolehan tanah untuk pendaftaran sertipikat.',
                'urutan'           => 15,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 16: PROSES HGB INDUK
            [
                'kode_dokumen'     => 'POIN-16',
                'nama_dokumen'     => 'Proses Penerbitan Buku HGB Induk',
                'kategori'         => 'Pertanahan & BPN',
                'instansi_terkait' => 'Kantor Pertanahan (ATR/BPN)',
                'estimasi_hari'    => 14,
                'estimasi_biaya'   => 1500000,
                'syarat_dokumen'   => "• SK HGB\n• SPTT PBB\n• Validasi BPHTB\n• Legalitas PT",
                'deskripsi'        => 'Pendaftaran berkas lengkap di loket BPN untuk pencatatan buku tanah dan pembukuan sertipikat induk.',
                'urutan'           => 16,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 17: SHGB INDUK SELESAI
            [
                'kode_dokumen'     => 'POIN-17',
                'nama_dokumen'     => 'SHGB Induk Selesai atas nama PT',
                'kategori'         => 'Pertanahan & BPN',
                'instansi_terkait' => 'Kantor Pertanahan (ATR/BPN)',
                'estimasi_hari'    => 7,
                'estimasi_biaya'   => 0,
                'syarat_dokumen'   => "• Berkas lengkap permohonan HGB Induk\n• Resi Tanda Terima BPN",
                'deskripsi'        => 'Buku Sertipikat SHGB Induk asli resmi terbit atas nama PT dan siap dimigrasikan ke Pasca Land Bank.',
                'urutan'           => 17,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 18: PEMECAHAN SHGB INDUK PERKAVLING
            [
                'kode_dokumen'     => 'POIN-18',
                'nama_dokumen'     => 'Proses Pemecahan SHGB Induk Perkavling (Pasca Land Bank)',
                'kategori'         => 'Pertanahan & BPN',
                'instansi_terkait' => 'Kantor Pertanahan (ATR/BPN) & Dinas Perkim/PUPR',
                'estimasi_hari'    => 30,
                'estimasi_biaya'   => 5000000,
                'syarat_dokumen'   => "• Asli SHGB INDUK\n• Siteplan yang sudah disahkan oleh Dinas Terkait\n• Legalitas PT",
                'deskripsi'        => 'Pengajuan pemecahan sertipikat SHGB Induk menjadi sertipikat pecahan masing-masing unit kavling sesuai pengesahan gambar siteplan.',
                'urutan'           => 18,
                'is_active'        => true,
                'is_required'      => true,
            ],

            // POIN 19: SERTIPIKAT SELESAI PER KAVLING
            [
                'kode_dokumen'     => 'POIN-19',
                'nama_dokumen'     => 'Sertipikat Selesai Per Kavling atas nama PT',
                'kategori'         => 'Pertanahan & BPN',
                'instansi_terkait' => 'Kantor Pertanahan (ATR/BPN)',
                'estimasi_hari'    => 14,
                'estimasi_biaya'   => 0,
                'syarat_dokumen'   => "• Berkas Pemecahan Sertipikat Per Kavling\n• Tanda Terima Penyerahan BPN",
                'deskripsi'        => 'Seluruh buku sertipikat pecahan per kavling an. PT telah selesai terbit dan siap digunakan untuk proses AJB / KPR unit konsumen.',
                'urutan'           => 19,
                'is_active'        => true,
                'is_required'      => true,
            ],
        ];

        foreach ($permits as $permit) {
            MasterDokumenPerizinan::updateOrCreate(
                ['kode_dokumen' => $permit['kode_dokumen']],
                $permit
            );
        }
    }
}
