<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Menu;
use App\Models\Notaris;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambahkan menu Data Notaris di bawah Master Data (parent_id: 29) jika belum ada
        $parentMaster = Menu::where('name', 'Master Data')->first();
        $parentId = $parentMaster ? $parentMaster->id : 29;

        $notarisMenu = Menu::firstOrCreate(
            ['route' => 'notaris.index'],
            [
                'name' => 'Data Notaris',
                'icon' => 'mdi-scale-balance',
                'parent_id' => $parentId,
                'order' => 12
            ]
        );

        // 2. Hubungkan permission menu ke posisi Admin & Legal
        if ($notarisMenu) {
            $positionsToAssign = [1, 3, 4, 5, 7]; // Kepala Marketing, Kepala Legal, Staff Legal, Admin, Staff Keuangan
            foreach ($positionsToAssign as $posId) {
                if (DB::table('positions')->where('id', $posId)->exists()) {
                    $exists = DB::table('menu_position')
                        ->where('menu_id', $notarisMenu->id)
                        ->where('position_id', $posId)
                        ->exists();

                    if (!$exists) {
                        DB::table('menu_position')->insert([
                            'menu_id' => $notarisMenu->id,
                            'position_id' => $posId
                        ]);
                    }
                }
            }
        }

        // 3. Seed default data notaris jika tabel masih kosong
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

            Notaris::create([
                'nama_notaris' => 'Bambang Trihatmodjo, S.H., M.Kn.',
                'no_sk' => 'AHU-00452.AH.02.01.TAHUN 2018',
                'wilayah_kerja' => 'Kabupaten Jember & Sekitarnya',
                'alamat_kantor' => 'Jl. Kalimantan No. 45, Sumbersari, Jember',
                'telepon' => '082198765432',
                'email' => 'notaris.bambang@gmail.com',
                'nama_kontak_person' => 'Ibu Ratna',
                'nama_bank' => 'BCA',
                'nomor_rekening' => '0249876512',
                'atas_nama_rekening' => 'Bambang Trihatmodjo',
                'keterangan' => 'Rekan notaris khusus sertifikasi & pemecahan tanah induk.',
                'is_active' => true,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $menu = Menu::where('route', 'notaris.index')->first();
        if ($menu) {
            DB::table('menu_position')->where('menu_id', $menu->id)->delete();
            $menu->delete();
        }
    }
};
