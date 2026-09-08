<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notaris;

class NotarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Notaris::count() === 0) {
            Notaris::create([
                'nama_notaris' => 'Siti Nurhaliza, S.H., M.Kn.',
                'no_sk' => 'AHU-00189.AH.02.01.TAHUN 2020',
                'wilayah_kerja' => 'Kabupaten Jember',
                'alamat_kantor' => 'Jl. Gajah Mada No. 128, Kaliwates, Jember, Jawa Timur',
                'telepon' => '081234567890',
                'email' => 'notaris.sitinurhaliza@gmail.com',
                'nama_kontak_person' => 'Bpk. Ahmad (Asisten Notaris)',
                'nama_bank' => 'Bank Mandiri',
                'nomor_rekening' => '1420019283741',
                'atas_nama_rekening' => 'Siti Nurhaliza, SH',
                'keterangan' => 'Jam operasional kantor: Senin - Jumat 08.00 - 16.00 WIB. Melayani akta PPJB, AJB, APHT, dan Pelepasan Hak Tanah.',
                'is_active' => true,
            ]);
        }
    }
}
