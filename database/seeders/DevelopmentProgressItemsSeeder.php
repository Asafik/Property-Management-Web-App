<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevelopmentProgressItemsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // ===== I. Pekerjaan Persiapan =====
            [
                'development_progress_id' => 1,
                'kategori' => 'persiapan',
                'kode' => '1.1',
                'uraian' => 'Pembersihan Lahan',
                'volume' => 1,
                'satuan' => 'ls',
                'harga_satuan' => 2000000,
                'total' => 2000000,
                'keterangan' => 'Manual',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'development_progress_id' => 1,
                'kategori' => 'persiapan',
                'kode' => '1.2',
                'uraian' => 'Pemasangan Pagar Pengaman',
                'volume' => 50,
                'satuan' => "m'",
                'harga_satuan' => 150000,
                'total' => 7500000,
                'keterangan' => 'Seng',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // ===== II. Pekerjaan Pondasi =====
            [
                'development_progress_id' => 1,
                'kategori' => 'pondasi',
                'kode' => '2.1',
                'uraian' => 'Galian Tanah Pondasi',
                'volume' => 20,
                'satuan' => 'm³',
                'harga_satuan' => 50000,
                'total' => 1000000,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'development_progress_id' => 1,
                'kategori' => 'pondasi',
                'kode' => '2.2',
                'uraian' => 'Pemasangan Pondasi Batu Kali',
                'volume' => 15,
                'satuan' => 'm³',
                'harga_satuan' => 250000,
                'total' => 3750000,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // ===== III. Struktur =====
            [
                'development_progress_id' => 1,
                'kategori' => 'struktur',
                'kode' => '3.1',
                'uraian' => 'Pengecoran Kolom',
                'volume' => 10,
                'satuan' => 'm³',
                'harga_satuan' => 800000,
                'total' => 8000000,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // ===== IV. Dinding =====
            [
                'development_progress_id' => 1,
                'kategori' => 'dinding',
                'kode' => '4.1',
                'uraian' => 'Pemasangan Bata Merah',
                'volume' => 100,
                'satuan' => 'm²',
                'harga_satuan' => 50000,
                'total' => 5000000,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // ===== V. Atap =====
            [
                'development_progress_id' => 1,
                'kategori' => 'atap',
                'kode' => '5.1',
                'uraian' => 'Rangka Atap Baja Ringan',
                'volume' => 50,
                'satuan' => "m²",
                'harga_satuan' => 150000,
                'total' => 7500000,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'development_progress_id' => 1,
                'kategori' => 'atap',
                'kode' => '5.2',
                'uraian' => 'Penutup Atap Genteng',
                'volume' => 50,
                'satuan' => "m²",
                'harga_satuan' => 100000,
                'total' => 5000000,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // ===== VI. Finishing =====
            [
                'development_progress_id' => 1,
                'kategori' => 'finishing',
                'kode' => '6.1',
                'uraian' => 'Plesteran dan Acian',
                'volume' => 80,
                'satuan' => 'm²',
                'harga_satuan' => 40000,
                'total' => 3200000,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'development_progress_id' => 1,
                'kategori' => 'finishing',
                'kode' => '6.2',
                'uraian' => 'Pengecatan Dinding',
                'volume' => 80,
                'satuan' => 'm²',
                'harga_satuan' => 30000,
                'total' => 2400000,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // ===== VII. Lainnya =====
            [
                'development_progress_id' => 1,
                'kategori' => 'lainnya',
                'kode' => '7.1',
                'uraian' => 'Pembersihan Akhir',
                'volume' => 1,
                'satuan' => 'ls',
                'harga_satuan' => 1000000,
                'total' => 1000000,
                'keterangan' => 'Final Check',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('development_progress_items')->insert($items);
    }
}
