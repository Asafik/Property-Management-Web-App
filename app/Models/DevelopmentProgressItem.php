<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rabs;

class DevelopmentProgressItem extends Model
{
    protected $fillable = [
        'development_progress_id',
        'kategori',
        'kode',
        'uraian',
        'volume',
        'satuan',
        'harga_satuan',
        'total',
        'keterangan',
        'deadline'
    ];
    protected $casts = [
    'deadline' => 'date'
];
    public function progress()
    {
        return $this->belongsTo(DevelopmentProgress::class, 'development_progress_id');
    }
    public function rabs()
{
    return $this->hasMany(Rabs::class);
}
public function documents()
{
    return $this->hasMany(DevelopmentItemDocument::class);
}

    /**
     * Standard Dynamic Template for RAB / RAP Construction & Permits
     */
    public static function getDefaultTemplateItems(): array
    {
        return [
            // I. PERIZINAN & LEGALITAS
            [
                'kategori'     => 'perizinan',
                'kode'         => 'P.1',
                'uraian'       => 'Persetujuan Bangunan Gedung (PBG / IMB) Unit Kavling',
                'volume'       => 1,
                'satuan'       => 'unit',
                'harga_satuan' => 4500000,
                'total'        => 4500000,
                'keterangan'   => 'Dinas PUPR & Perizinan Terpadu',
            ],
            [
                'kategori'     => 'perizinan',
                'kode'         => 'P.2',
                'uraian'       => 'Pemecahan & Penerbitan Sertifikat (HGB / SHM) Kavling',
                'volume'       => 1,
                'satuan'       => 'berkas',
                'harga_satuan' => 3500000,
                'total'        => 3500000,
                'keterangan'   => 'Kantor Pertanahan / BPN',
            ],
            [
                'kategori'     => 'perizinan',
                'kode'         => 'P.3',
                'uraian'       => 'Jasa Notaris & Pejabat Pembuat Akta Tanah (PPAT)',
                'volume'       => 1,
                'satuan'       => 'paket',
                'harga_satuan' => 3000000,
                'total'        => 3000000,
                'keterangan'   => 'Validasi Pajak & Akta Notaris',
            ],
            [
                'kategori'     => 'perizinan',
                'kode'         => 'P.4',
                'uraian'       => 'Keterangan Rencana Kota (KRK) & Peil Bebas Banjir',
                'volume'       => 1,
                'satuan'       => 'paket',
                'harga_satuan' => 1500000,
                'total'        => 1500000,
                'keterangan'   => 'Tata Ruang Wilayah',
            ],
            [
                'kategori'     => 'perizinan',
                'kode'         => 'P.5',
                'uraian'       => 'Penyambungan Daya Listrik PLN 1300 VA & Air Bersih (PDAM / Sumur)',
                'volume'       => 1,
                'satuan'       => 'paket',
                'harga_satuan' => 2500000,
                'total'        => 2500000,
                'keterangan'   => 'Instalasi Meteran PLN & Pipa Air',
            ],

            // II. PEKERJAAN PERSIAPAN
            [
                'kategori'     => 'persiapan',
                'kode'         => '1.1',
                'uraian'       => 'Pembersihan Lokasi, Urugan, & Bouwplank Pengukuran',
                'volume'       => 1,
                'satuan'       => 'ls',
                'harga_satuan' => 2000000,
                'total'        => 2000000,
                'keterangan'   => 'Kayu 5/7 & Papan Kayu Meranti',
            ],
            [
                'kategori'     => 'persiapan',
                'kode'         => '1.2',
                'uraian'       => 'Pengukuran Elevasi, Peil Lantai & Pasang Patok Kavling',
                'volume'       => 1,
                'satuan'       => 'paket',
                'harga_satuan' => 1000000,
                'total'        => 1000000,
                'keterangan'   => 'Theodolite / Waterpass',
            ],

            // III. PEKERJAAN PONDASI
            [
                'kategori'     => 'pondasi',
                'kode'         => '2.1',
                'uraian'       => 'Galian Tanah Pondasi Batu Kali & Urugan Pasir Alas',
                'volume'       => 25,
                'satuan'       => 'm³',
                'harga_satuan' => 75000,
                'total'        => 1875000,
                'keterangan'   => 'Kedalaman galian 80 cm',
            ],
            [
                'kategori'     => 'pondasi',
                'kode'         => '2.2',
                'uraian'       => 'Pasangan Pondasi Batu Kali Campuran 1:4 (Aanstamping)',
                'volume'       => 18,
                'satuan'       => 'm³',
                'harga_satuan' => 380000,
                'total'        => 6840000,
                'keterangan'   => 'Batu belah & pasir pasang',
            ],
            [
                'kategori'     => 'pondasi',
                'kode'         => '2.3',
                'uraian'       => 'Pekerjaan Sloof Beton Bertulang 15/20 (Besi 10mm & Begel 6mm)',
                'volume'       => 42,
                'satuan'       => 'm\'',
                'harga_satuan' => 145000,
                'total'        => 6090000,
                'keterangan'   => 'Mutu Beton K-225',
            ],

            // IV. PEKERJAAN STRUKTUR
            [
                'kategori'     => 'struktur',
                'kode'         => '3.1',
                'uraian'       => 'Kolom Praktis Beton Bertulang 15/15',
                'volume'       => 36,
                'satuan'       => 'm\'',
                'harga_satuan' => 95000,
                'total'        => 3420000,
                'keterangan'   => 'Besi 10mm ulir & begel 6mm',
            ],
            [
                'kategori'     => 'struktur',
                'kode'         => '3.2',
                'uraian'       => 'Ringbalk Beton Bertulang 15/20',
                'volume'       => 42,
                'satuan'       => 'm\'',
                'harga_satuan' => 125000,
                'total'        => 5250000,
                'keterangan'   => 'Pengikat pasangan dinding atas',
            ],
            [
                'kategori'     => 'struktur',
                'kode'         => '3.3',
                'uraian'       => 'Cor Plat / Canopy Beton Teras & Talang Beton',
                'volume'       => 1,
                'satuan'       => 'ls',
                'harga_satuan' => 2500000,
                'total'        => 2500000,
                'keterangan'   => 'Waterproofing Sika',
            ],

            // V. PEKERJAAN DINDING
            [
                'kategori'     => 'dinding',
                'kode'         => '4.1',
                'uraian'       => 'Pasangan Dinding Bata Ringan (Hebel) tebal 10 cm & Thinbed Mortar',
                'volume'       => 135,
                'satuan'       => 'm²',
                'harga_satuan' => 85000,
                'total'        => 11475000,
                'keterangan'   => 'Perekat mortar instan',
            ],
            [
                'kategori'     => 'dinding',
                'kode'         => '4.2',
                'uraian'       => 'Plesteran & Acian Halus Dinding Interior & Eksterior',
                'volume'       => 260,
                'satuan'       => 'm²',
                'harga_satuan' => 65000,
                'total'        => 16900000,
                'keterangan'   => 'Mortar plester & acian halus',
            ],

            // VI. PEKERJAAN ATAP
            [
                'kategori'     => 'atap',
                'kode'         => '5.1',
                'uraian'       => 'Rangka Atap Kuda-Kuda Baja Ringan Truss C75.75 & Reng 0.45',
                'volume'       => 65,
                'satuan'       => 'm²',
                'harga_satuan' => 165000,
                'total'        => 10725000,
                'keterangan'   => 'Garansi struktur baja ringan',
            ],
            [
                'kategori'     => 'atap',
                'kode'         => '5.2',
                'uraian'       => 'Penutup Atap Genteng Beton Flat / Metal Pasir & Nok Bubungan',
                'volume'       => 65,
                'satuan'       => 'm²',
                'harga_satuan' => 120000,
                'total'        => 7800000,
                'keterangan'   => 'Cat pelapis anti bocor',
            ],
            [
                'kategori'     => 'atap',
                'kode'         => '5.3',
                'uraian'       => 'Pemasangan Plafon Gypsum Board 9mm & Rangka Hollow Galvalum',
                'volume'       => 50,
                'satuan'       => 'm²',
                'harga_satuan' => 95000,
                'total'        => 4750000,
                'keterangan'   => 'List profil gypsum keliling',
            ],

            // VII. PEKERJAAN FINISHING
            [
                'kategori'     => 'finishing',
                'kode'         => '6.1',
                'uraian'       => 'Pasang Lantai Granit Tile 60x60 Polished & Plint Dinding',
                'volume'       => 45,
                'satuan'       => 'm²',
                'harga_satuan' => 175000,
                'total'        => 7875000,
                'keterangan'   => 'Granit Homogenous Tile',
            ],
            [
                'kategori'     => 'finishing',
                'kode'         => '6.2',
                'uraian'       => 'Pasang Keramik Lantai & Dinding Kamar Mandi + Waterproofing',
                'volume'       => 15,
                'satuan'       => 'm²',
                'harga_satuan' => 150000,
                'total'        => 2250000,
                'keterangan'   => 'Keramik anti selip 25x25 & 25x40',
            ],
            [
                'kategori'     => 'finishing',
                'kode'         => '6.3',
                'uraian'       => 'Kusen Aluminium 3 inch, Pintu Panel Utama & Jendela Kaca',
                'volume'       => 1,
                'satuan'       => 'paket',
                'harga_satuan' => 8500000,
                'total'        => 8500000,
                'keterangan'   => 'Kaca polos 5mm & handle kunci set',
            ],
            [
                'kategori'     => 'finishing',
                'kode'         => '6.4',
                'uraian'       => 'Instalasi Sanitair (Kloset Duduk, Hand Shower, Jetwasher & Kran)',
                'volume'       => 1,
                'satuan'       => 'paket',
                'harga_satuan' => 3500000,
                'total'        => 3500000,
                'keterangan'   => 'Merk American Standard / Setara',
            ],
            [
                'kategori'     => 'finishing',
                'kode'         => '6.5',
                'uraian'       => 'Pengecatan Dinding Interior & Eksterior (Weathercoat)',
                'volume'       => 260,
                'satuan'       => 'm²',
                'harga_satuan' => 35000,
                'total'        => 9100000,
                'keterangan'   => 'Cat Jotun / Dulux 2 lapis',
            ],

            // VIII. PEKERJAAN LAINNYA
            [
                'kategori'     => 'lainnya',
                'kode'         => '7.1',
                'uraian'       => 'Pekerjaan Carport Cor Beton Rabat, Tali Air & Kanstein Pembatas',
                'volume'       => 15,
                'satuan'       => 'm²',
                'harga_satuan' => 180000,
                'total'        => 2700000,
                'keterangan'   => 'Tekstur sikat anti slip',
            ],
            [
                'kategori'     => 'lainnya',
                'kode'         => '7.2',
                'uraian'       => 'Pemasangan Bio Septic Tank 1000L & Sumur Resapan Air Kotor',
                'volume'       => 1,
                'satuan'       => 'unit',
                'harga_satuan' => 3200000,
                'total'        => 3200000,
                'keterangan'   => 'Biofilter ramah lingkungan',
            ],
            [
                'kategori'     => 'lainnya',
                'kode'         => '7.3',
                'uraian'       => 'Pembersihan Akhir (General Cleaning) & Finishing Pra Serah Terima',
                'volume'       => 1,
                'satuan'       => 'ls',
                'harga_satuan' => 1000000,
                'total'        => 1000000,
                'keterangan'   => 'Pembersihan kaca, lantai, & uji fungsi utilitas',
            ],
        ];
    }
}
