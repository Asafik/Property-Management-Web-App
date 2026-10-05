<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\MasterProgressCategory;
use App\Models\MasterProgressItem;
use App\Models\DevelopmentProgressItem;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Hapus master category 'perizinan' (Prefix P) dan item-item di dalamnya
        $perizinanCat = MasterProgressCategory::where('slug', 'perizinan')->first();
        if ($perizinanCat) {
            MasterProgressItem::where('master_progress_category_id', $perizinanCat->id)->delete();
            $perizinanCat->delete();
        }

        // Hapus juga jika ada progress item unit berkategori perizinan pada RAP unit
        DevelopmentProgressItem::where('kategori', 'perizinan')->delete();

        // 2. Perbarui nama kategori dan urutan agar dimulai dari I. PEKERJAAN PERSIAPAN
        $mappings = [
            'persiapan' => ['nama' => 'I. PEKERJAAN PERSIAPAN', 'urutan' => 1, 'prefix' => '1'],
            'pondasi'   => ['nama' => 'II. PEKERJAAN PONDASI', 'urutan' => 2, 'prefix' => '2'],
            'struktur'  => ['nama' => 'III. PEKERJAAN STRUKTUR', 'urutan' => 3, 'prefix' => '3'],
            'dinding'   => ['nama' => 'IV. PEKERJAAN DINDING', 'urutan' => 4, 'prefix' => '4'],
            'atap'      => ['nama' => 'V. PEKERJAAN ATAP', 'urutan' => 5, 'prefix' => '5'],
            'finishing' => ['nama' => 'VI. PEKERJAAN FINISHING', 'urutan' => 6, 'prefix' => '6'],
            'lainnya'   => ['nama' => 'VII. PEKERJAAN LAINNYA', 'urutan' => 7, 'prefix' => '7'],
        ];

        foreach ($mappings as $slug => $data) {
            MasterProgressCategory::where('slug', $slug)->update([
                'nama_kategori' => $data['nama'],
                'urutan'        => $data['urutan'],
                'prefix'        => $data['prefix'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback ke struktur sebelumnya jika diperlukan
        $cat = MasterProgressCategory::firstOrCreate(
            ['slug' => 'perizinan'],
            [
                'nama_kategori' => 'I. PERIZINAN & LEGALITAS (PBG/IMB, SERTIFIKAT, DLL)',
                'prefix'        => 'P',
                'icon'          => 'file-certificate-outline',
                'urutan'        => 1,
                'is_active'     => true,
            ]
        );

        $mappings = [
            'persiapan' => ['nama' => 'II. PEKERJAAN PERSIAPAN', 'urutan' => 2, 'prefix' => '1'],
            'pondasi'   => ['nama' => 'III. PEKERJAAN PONDASI', 'urutan' => 3, 'prefix' => '2'],
            'struktur'  => ['nama' => 'IV. PEKERJAAN STRUKTUR', 'urutan' => 4, 'prefix' => '3'],
            'dinding'   => ['nama' => 'V. PEKERJAAN DINDING', 'urutan' => 5, 'prefix' => '4'],
            'atap'      => ['nama' => 'VI. PEKERJAAN ATAP', 'urutan' => 6, 'prefix' => '5'],
            'finishing' => ['nama' => 'VII. PEKERJAAN FINISHING', 'urutan' => 7, 'prefix' => '6'],
            'lainnya'   => ['nama' => 'VIII. PEKERJAAN LAINNYA', 'urutan' => 8, 'prefix' => '7'],
        ];

        foreach ($mappings as $slug => $data) {
            MasterProgressCategory::where('slug', $slug)->update([
                'nama_kategori' => $data['nama'],
                'urutan'        => $data['urutan'],
                'prefix'        => $data['prefix'],
            ]);
        }
    }
};
