<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\DevelopmentProgress;
use App\Models\DevelopmentProgressItem;
use App\Models\MasterProgressCategory;
use App\Models\MasterProgressItem;

class DevelopmentProgressItemsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Master Categories & Master Items
        $categoriesData = [
            [
                'nama_kategori' => 'I. PERIZINAN & LEGALITAS (PBG/IMB, SERTIFIKAT, DLL)',
                'slug'          => 'perizinan',
                'prefix'        => 'P',
                'icon'          => 'file-certificate-outline',
                'urutan'        => 1,
                'items'         => [
                    ['kode' => 'P.1', 'uraian' => 'Persetujuan Bangunan Gedung (PBG / IMB) Unit Kavling', 'default_volume' => 1, 'satuan' => 'unit', 'default_harga_satuan' => 4500000, 'keterangan' => 'Dinas PUPR & Perizinan Terpadu'],
                    ['kode' => 'P.2', 'uraian' => 'Pemecahan & Penerbitan Sertifikat (HGB / SHM) Kavling', 'default_volume' => 1, 'satuan' => 'berkas', 'default_harga_satuan' => 3500000, 'keterangan' => 'Kantor Pertanahan / BPN'],
                    ['kode' => 'P.3', 'uraian' => 'Jasa Notaris & Pejabat Pembuat Akta Tanah (PPAT)', 'default_volume' => 1, 'satuan' => 'paket', 'default_harga_satuan' => 3000000, 'keterangan' => 'Validasi Pajak & Akta Notaris'],
                    ['kode' => 'P.4', 'uraian' => 'Keterangan Rencana Kota (KRK) & Peil Bebas Banjir', 'default_volume' => 1, 'satuan' => 'paket', 'default_harga_satuan' => 1500000, 'keterangan' => 'Tata Ruang Wilayah'],
                    ['kode' => 'P.5', 'uraian' => 'Penyambungan Daya Listrik PLN 1300 VA & Air Bersih (PDAM / Sumur)', 'default_volume' => 1, 'satuan' => 'paket', 'default_harga_satuan' => 2500000, 'keterangan' => 'Instalasi Meteran PLN & Pipa Air'],
                ]
            ],
            [
                'nama_kategori' => 'II. PEKERJAAN PERSIAPAN',
                'slug'          => 'persiapan',
                'prefix'        => '1',
                'icon'          => 'tools',
                'urutan'        => 2,
                'items'         => [
                    ['kode' => '1.1', 'uraian' => 'Pembersihan Lokasi, Urugan, & Bouwplank Pengukuran', 'default_volume' => 1, 'satuan' => 'ls', 'default_harga_satuan' => 2000000, 'keterangan' => 'Kayu 5/7 & Papan Kayu Meranti'],
                    ['kode' => '1.2', 'uraian' => 'Pengukuran Elevasi, Peil Lantai & Pasang Patok Kavling', 'default_volume' => 1, 'satuan' => 'paket', 'default_harga_satuan' => 1000000, 'keterangan' => 'Theodolite / Waterpass'],
                ]
            ],
            [
                'nama_kategori' => 'III. PEKERJAAN PONDASI',
                'slug'          => 'pondasi',
                'prefix'        => '2',
                'icon'          => 'foundation',
                'urutan'        => 3,
                'items'         => [
                    ['kode' => '2.1', 'uraian' => 'Galian Tanah Pondasi Batu Kali & Urugan Pasir Alas', 'default_volume' => 25, 'satuan' => 'm³', 'default_harga_satuan' => 75000, 'keterangan' => 'Kedalaman galian 80 cm'],
                    ['kode' => '2.2', 'uraian' => 'Pasangan Pondasi Batu Kali Campuran 1:4 (Aanstamping)', 'default_volume' => 18, 'satuan' => 'm³', 'default_harga_satuan' => 380000, 'keterangan' => 'Batu belah & pasir pasang'],
                    ['kode' => '2.3', 'uraian' => 'Pekerjaan Sloof Beton Bertulang 15/20 (Besi 10mm & Begel 6mm)', 'default_volume' => 42, 'satuan' => 'm\'', 'default_harga_satuan' => 145000, 'keterangan' => 'Mutu Beton K-225'],
                ]
            ],
            [
                'nama_kategori' => 'IV. PEKERJAAN STRUKTUR',
                'slug'          => 'struktur',
                'prefix'        => '3',
                'icon'          => 'bridge',
                'urutan'        => 4,
                'items'         => [
                    ['kode' => '3.1', 'uraian' => 'Kolom Praktis Beton Bertulang 15/15', 'default_volume' => 36, 'satuan' => 'm\'', 'default_harga_satuan' => 95000, 'keterangan' => 'Besi 10mm ulir & begel 6mm'],
                    ['kode' => '3.2', 'uraian' => 'Ringbalk Beton Bertulang 15/20', 'default_volume' => 42, 'satuan' => 'm\'', 'default_harga_satuan' => 125000, 'keterangan' => 'Pengikat pasangan dinding atas'],
                    ['kode' => '3.3', 'uraian' => 'Cor Plat / Canopy Beton Teras & Talang Beton', 'default_volume' => 1, 'satuan' => 'ls', 'default_harga_satuan' => 2500000, 'keterangan' => 'Waterproofing Sika'],
                ]
            ],
            [
                'nama_kategori' => 'V. PEKERJAAN DINDING',
                'slug'          => 'dinding',
                'prefix'        => '4',
                'icon'          => 'wall',
                'urutan'        => 5,
                'items'         => [
                    ['kode' => '4.1', 'uraian' => 'Pasangan Dinding Bata Ringan (Hebel) tebal 10 cm & Thinbed Mortar', 'default_volume' => 135, 'satuan' => 'm²', 'default_harga_satuan' => 85000, 'keterangan' => 'Perekat mortar instan'],
                    ['kode' => '4.2', 'uraian' => 'Plesteran & Acian Halus Dinding Interior & Eksterior', 'default_volume' => 260, 'satuan' => 'm²', 'default_harga_satuan' => 65000, 'keterangan' => 'Mortar plester & acian halus'],
                ]
            ],
            [
                'nama_kategori' => 'VI. PEKERJAAN ATAP',
                'slug'          => 'atap',
                'prefix'        => '5',
                'icon'          => 'roofing',
                'urutan'        => 6,
                'items'         => [
                    ['kode' => '5.1', 'uraian' => 'Rangka Atap Kuda-Kuda Baja Ringan Truss C75.75 & Reng 0.45', 'default_volume' => 65, 'satuan' => 'm²', 'default_harga_satuan' => 165000, 'keterangan' => 'Garansi struktur baja ringan'],
                    ['kode' => '5.2', 'uraian' => 'Penutup Atap Genteng Beton Flat / Metal Pasir & Nok Bubungan', 'default_volume' => 65, 'satuan' => 'm²', 'default_harga_satuan' => 120000, 'keterangan' => 'Cat pelapis anti bocor'],
                    ['kode' => '5.3', 'uraian' => 'Pemasangan Plafon Gypsum Board 9mm & Rangka Hollow Galvalum', 'default_volume' => 50, 'satuan' => 'm²', 'default_harga_satuan' => 95000, 'keterangan' => 'List profil gypsum keliling'],
                ]
            ],
            [
                'nama_kategori' => 'VII. PEKERJAAN FINISHING',
                'slug'          => 'finishing',
                'prefix'        => '6',
                'icon'          => 'brush',
                'urutan'        => 7,
                'items'         => [
                    ['kode' => '6.1', 'uraian' => 'Pasang Lantai Granit Tile 60x60 Polished & Plint Dinding', 'default_volume' => 45, 'satuan' => 'm²', 'default_harga_satuan' => 175000, 'keterangan' => 'Granit Homogenous Tile'],
                    ['kode' => '6.2', 'uraian' => 'Pasang Keramik Lantai & Dinding Kamar Mandi + Waterproofing', 'default_volume' => 15, 'satuan' => 'm²', 'default_harga_satuan' => 150000, 'keterangan' => 'Keramik anti selip 25x25 & 25x40'],
                    ['kode' => '6.3', 'uraian' => 'Kusen Aluminium 3 inch, Pintu Panel Utama & Jendela Kaca', 'default_volume' => 1, 'satuan' => 'paket', 'default_harga_satuan' => 8500000, 'keterangan' => 'Kaca polos 5mm & handle kunci set'],
                    ['kode' => '6.4', 'uraian' => 'Instalasi Sanitair (Kloset Duduk, Hand Shower, Jetwasher & Kran)', 'default_volume' => 1, 'satuan' => 'paket', 'default_harga_satuan' => 3500000, 'keterangan' => 'Merk American Standard / Setara'],
                    ['kode' => '6.5', 'uraian' => 'Pengecatan Dinding Interior & Eksterior (Weathercoat)', 'default_volume' => 260, 'satuan' => 'm²', 'default_harga_satuan' => 35000, 'keterangan' => 'Cat Jotun / Dulux 2 lapis'],
                ]
            ],
            [
                'nama_kategori' => 'VIII. PEKERJAAN LAINNYA',
                'slug'          => 'lainnya',
                'prefix'        => '7',
                'icon'          => 'dots-horizontal',
                'urutan'        => 8,
                'items'         => [
                    ['kode' => '7.1', 'uraian' => 'Pekerjaan Carport Cor Beton Rabat, Tali Air & Kanstein Pembatas', 'default_volume' => 15, 'satuan' => 'm²', 'default_harga_satuan' => 180000, 'keterangan' => 'Tekstur sikat anti slip'],
                    ['kode' => '7.2', 'uraian' => 'Pemasangan Bio Septic Tank 1000L & Sumur Resapan Air Kotor', 'default_volume' => 1, 'satuan' => 'unit', 'default_harga_satuan' => 3200000, 'keterangan' => 'Biofilter ramah lingkungan'],
                    ['kode' => '7.3', 'uraian' => 'Pembersihan Akhir (General Cleaning) & Finishing Pra Serah Terima', 'default_volume' => 1, 'satuan' => 'ls', 'default_harga_satuan' => 1000000, 'keterangan' => 'Pembersihan kaca, lantai, & uji fungsi utilitas'],
                ]
            ],
        ];

        foreach ($categoriesData as $catData) {
            $items = $catData['items'];
            unset($catData['items']);

            $cat = MasterProgressCategory::updateOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );

            foreach ($items as $idx => $itemData) {
                MasterProgressItem::updateOrCreate(
                    [
                        'master_progress_category_id' => $cat->id,
                        'kode'                        => $itemData['kode'],
                    ],
                    array_merge($itemData, [
                        'urutan' => $idx + 1,
                    ])
                );
            }
        }

        // 2. Ambil atau pastikan ada LandBank / Unit
        $land = LandBank::first();
        if (!$land) {
            $land = LandBank::create([
                'name'               => 'Grand Permata Estate',
                'area'               => 15000,
                'remaining_area'     => 15000,
                'acquisition_price'  => 3500000000,
                'acquisition_date'   => '2026-01-10',
                'address'            => 'Jl. Raya Permata Hijau No. 88',
                'village'            => 'Cimanggis',
                'district'           => 'Tapos',
                'city'               => 'Depok',
                'province'           => 'Jawa Barat',
                'legal_status'       => 'verified',
                'development_status' => 'selesai',
            ]);
        }

        // 3. Ambil atau buat minimal 1 Unit Contoh (Harga Jual 200 Juta)
        $unit = LandBankUnit::first();
        if (!$unit) {
            $unit = LandBankUnit::create([
                'land_bank_id'          => $land->id,
                'block'                 => 'A',
                'unit_number'           => '01',
                'unit_code'             => 'A-01',
                'unit_name'             => 'Kavling Tipe 36/72 Hook',
                'type'                  => '36/72',
                'area'                  => 72,
                'building_area'         => 36,
                'price'                 => 200000000,
                'facing'                => 'Utara',
                'position'              => 'Hook',
                'status'                => 'ready',
                'construction_progress' => 'pondasi',
            ]);
        } else {
            $unit->update(['price' => 200000000]);
        }

        // 4. Pastikan ada DevelopmentProgress
        $progress = DevelopmentProgress::firstOrCreate(
            ['land_bank_unit_id' => $unit->id],
            ['title' => 'Progress Pembangunan Unit ' . $unit->unit_code]
        );

        // 5. Hapus data lama pada progress ini jika ada
        DevelopmentProgressItem::where('development_progress_id', $progress->id)->delete();

        // 6. Masukkan seluruh template dari Master Categories
        $allMasterCategories = MasterProgressCategory::with('items')->where('is_active', true)->orderBy('urutan')->get();
        $totalItemsCount = 0;

        foreach ($allMasterCategories as $masterCat) {
            foreach ($masterCat->items as $masterItem) {
                DevelopmentProgressItem::create([
                    'development_progress_id' => $progress->id,
                    'kategori'                => $masterCat->slug,
                    'kode'                    => $masterItem->kode,
                    'uraian'                  => $masterItem->uraian,
                    'volume'                  => $masterItem->default_volume,
                    'satuan'                  => $masterItem->satuan,
                    'harga_satuan'            => $masterItem->default_harga_satuan,
                    'total'                   => round($masterItem->default_volume * $masterItem->default_harga_satuan),
                    'keterangan'              => $masterItem->keterangan,
                ]);
                $totalItemsCount++;
            }
        }

        // 7. Hitung total anggaran progress
        $subtotal = $progress->items()->sum('total');
        $ppn = round($subtotal * 0.1);
        $totalAnggaran = $subtotal + $ppn;

        $progress->update([
            'total_anggaran' => $totalAnggaran,
            'status'         => 'ongoing',
        ]);

        $this->command->info("✓ Master Kategori Dinamis & Seeder RAP Pembangunan berhasil dijalankan ({$totalItemsCount} item di 8 tahapan) dengan harga jual unit Rp 200.000.000.");
    }
}
