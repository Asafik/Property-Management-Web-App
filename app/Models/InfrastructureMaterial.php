<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfrastructureMaterial extends Model
{
    use HasFactory;

    protected $table = 'infrastructure_materials';

    protected $fillable = [
        'code',
        'name',
        'category',
        'unit',
        'default_price',
        'specification',
        'is_active',
    ];

    protected $casts = [
        'default_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Expenses referencing this master material
     */
    public function expenses()
    {
        return $this->hasMany(LandBankInfrastructureExpense::class, 'material_id');
    }

    /**
     * Seed default master items if empty
     */
    public static function seedDefaultMaterials()
    {
        $defaults = [
            // PJU & Penerangan
            ['code' => 'MAT-PJU-001', 'name' => 'Tiang Lampu PJU Oktagonal 7 Meter', 'category' => 'PJU & Penerangan', 'unit' => 'batang', 'default_price' => 1750000, 'specification' => 'Hot Dip Galvanized + Baseplate 300x300'],
            ['code' => 'MAT-PJU-002', 'name' => 'Lampu PJU LED 60 Watt Philips', 'category' => 'PJU & Penerangan', 'unit' => 'unit', 'default_price' => 450000, 'specification' => 'IP66 Waterproof, Warm White/Cool Daylight'],
            ['code' => 'MAT-PJU-003', 'name' => 'Kabel Power NYFGBY 4x6 mm', 'category' => 'PJU & Penerangan', 'unit' => 'meter', 'default_price' => 45000, 'specification' => 'Kabel Tanam Armor Tembaga 4 Core'],
            ['code' => 'MAT-PJU-004', 'name' => 'Box Panel PJU + Timer & MCB', 'category' => 'PJU & Penerangan', 'unit' => 'unit', 'default_price' => 1200000, 'specification' => 'Outdoor Panel Box IP65 + Timer Otomatis'],

            // Drainase & Selokan
            ['code' => 'MAT-DRN-001', 'name' => 'U-Ditch Beton 40x40x120 cm', 'category' => 'Drainase & Sanitasi', 'unit' => 'unit', 'default_price' => 165000, 'specification' => 'Saluran Pracetak K-350'],
            ['code' => 'MAT-DRN-002', 'name' => 'Cover U-Ditch Heavy Duty 40 cm', 'category' => 'Drainase & Sanitasi', 'unit' => 'unit', 'default_price' => 85000, 'specification' => 'Tutup Saluran Kuat Menahan Beban Kendaraan'],
            ['code' => 'MAT-DRN-003', 'name' => 'Batu Belah / Batu Kali Pondasi', 'category' => 'Drainase & Sanitasi', 'unit' => 'm3', 'default_price' => 240000, 'specification' => 'Batu Kali Keras untuk Dinding Selokan / Talud'],
            ['code' => 'MAT-DRN-004', 'name' => 'Semen Gresik / Tiga Roda 40 Kg', 'category' => 'Drainase & Sanitasi', 'unit' => 'sak', 'default_price' => 58000, 'specification' => 'PPC Standard SNI'],
            ['code' => 'MAT-DRN-005', 'name' => 'Pasir Pasang Lumajang', 'category' => 'Drainase & Sanitasi', 'unit' => 'm3', 'default_price' => 280000, 'specification' => 'Pasir Gunung Hitam Bersih'],

            // Jalan & Akses
            ['code' => 'MAT-JLN-001', 'name' => 'Paving Block K-300 Tebal 6 cm (Press Mesin)', 'category' => 'Aksesibilitas Jalan', 'unit' => 'm2', 'default_price' => 75000, 'specification' => 'Model Bata 10x20 cm K-300'],
            ['code' => 'MAT-JLN-002', 'name' => 'Kanstein / Pembatas Paving 40x20x10 cm', 'category' => 'Aksesibilitas Jalan', 'unit' => 'unit', 'default_price' => 22000, 'specification' => 'Tepi Jalan Kunci Paving'],
            ['code' => 'MAT-JLN-003', 'name' => 'Batu Makadam / Sirtu Alas Jalan', 'category' => 'Aksesibilitas Jalan', 'unit' => 'm3', 'default_price' => 190000, 'specification' => 'Lapisan Base Course Pemadatan Jalan'],

            // Pematangan & Alat Berat
            ['code' => 'MAT-ALT-001', 'name' => 'Sewa Excavator Komatsu PC200 + Operator', 'category' => 'Pematangan Lahan', 'unit' => 'jam', 'default_price' => 185000, 'specification' => 'Pekerjaan Cut & Fill / Perataan (Min 50 Jam)'],
            ['code' => 'MAT-ALT-002', 'name' => 'Sewa Vibro Roller 8-10 Ton', 'category' => 'Pematangan Lahan', 'unit' => 'hari', 'default_price' => 1500000, 'specification' => 'Pemadatan Sub-Grade Tanah Jalan Kawasan'],
            ['code' => 'MAT-ALT-003', 'name' => 'BBM Solar Industri Alat Berat', 'category' => 'Pematangan Lahan', 'unit' => 'liter', 'default_price' => 15500, 'specification' => 'Solar Dexlite / Industri untuk Excavator & Dump Truck'],
            ['code' => 'MAT-ALT-004', 'name' => 'Tanah Urug / Sirtu Super', 'category' => 'Pematangan Lahan', 'unit' => 'rit', 'default_price' => 380000, 'specification' => 'Dump Truck Indeks 7-8 m3'],

            // Air Bersih
            ['code' => 'MAT-AIR-001', 'name' => 'Pipa PVC AW 3 Inch Wavin/Rucika (4m)', 'category' => 'Jaringan Air Bersih', 'unit' => 'batang', 'default_price' => 145000, 'specification' => 'Pipa Distribusi Utama Air Bersih'],
            ['code' => 'MAT-AIR-002', 'name' => 'Pipa PVC AW 1.5 Inch (4m)', 'category' => 'Jaringan Air Bersih', 'unit' => 'batang', 'default_price' => 75000, 'specification' => 'Pipa Distribusi ke Blok Kavling'],
            ['code' => 'MAT-AIR-003', 'name' => 'Water Meter Induk & Gate Valve', 'category' => 'Jaringan Air Bersih', 'unit' => 'unit', 'default_price' => 650000, 'specification' => 'Meteran Air Kuningan 2 Inch'],

            // Listrik & Gerbang
            ['code' => 'MAT-ELC-001', 'name' => 'Biaya Penyambungan Trafo / Jaringan PLN Kawasan', 'category' => 'Jaringan Listrik & Gerbang', 'unit' => 'paket', 'default_price' => 15000000, 'specification' => 'Penyambungan Daya Induk PLN Distribusi Tiang Beton'],
            ['code' => 'MAT-ELC-002', 'name' => 'Pembangunan Gapura & Pos Satpam Kawasan', 'category' => 'Jaringan Listrik & Gerbang', 'unit' => 'paket', 'default_price' => 25000000, 'specification' => 'Struktur Besi Hollow + ACP + Pos Jaga'],

            // Upah Tenaga Kerja
            ['code' => 'MAT-UPH-001', 'name' => 'Upah Harian Tukang Bangunan', 'category' => 'Upah Tenaga Kerja', 'unit' => 'hari', 'default_price' => 120000, 'specification' => 'Tukang Batu / Besi / Pasang Saluran'],
            ['code' => 'MAT-UPH-002', 'name' => 'Upah Harian Pekerja / Kenek', 'category' => 'Upah Tenaga Kerja', 'unit' => 'hari', 'default_price' => 90000, 'specification' => 'Tenaga Gali & Angkut Material'],
            ['code' => 'MAT-UPH-003', 'name' => 'Upah Mandor Lapangan', 'category' => 'Upah Tenaga Kerja', 'unit' => 'hari', 'default_price' => 150000, 'specification' => 'Supervisi Teknis & Logistik Lapangan'],
        ];

        foreach ($defaults as $item) {
            self::firstOrCreate(['code' => $item['code']], $item);
        }
    }
}
