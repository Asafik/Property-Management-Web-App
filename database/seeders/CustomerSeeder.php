<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'customer_id' => 'CUST-001',
                'full_name' => 'Ahmad Fauzi',
                'nickname' => 'Fauzi',
                'nik' => 3276010101010001,
                'no_kk' => 3276010101010000,
                'birthplace' => 'Bandung',
                'date_birth' => '1990-01-01',
                'age' => 36,
                'gender' => 'Laki-laki',
                'religion' => 'Islam',
                'nationality' => 'WNI',
                'marital_status' => 'Menikah',
                'marital_date' => '2015-06-15',
                'child_count' => 2,

                'province' => 'Jawa Barat',
                'city' => 'Bandung',
                'subdistrict' => 'Coblong',
                'village' => 'Dago',
                'rt' => '01',
                'rw' => '05',
                'postal_code' => 40135,
                'address' => 'Jl. Dago No. 123',

                'domicile_province' => 'Jawa Barat',
                'domicile_city' => 'Bandung',
                'domicile_subdistrict' => 'Coblong',
                'domicile_village' => 'Dago',
                'domicile_rt' => '01',
                'domicile_rw' => '05',
                'domicile_postal_code' => 40135,
                'domicile_address' => 'Jl. Dago No. 123',

                'phone' => '081234567890',
                'home_phone' => '0221234567',
                'email' => 'ahmad@example.com',
                'office_email' => 'ahmad.office@example.com',

                'instagram' => '@ahmadfauzi',
                'facebook' => 'ahmad.fauzi',
                'tiktok' => '@ahmadf',
                'x' => '@ahmadx',

                'job_status' => 'Karyawan Swasta',
                'job_status_lainnya' => null,
                'company_name' => 'PT Maju Jaya',
                'main_income' => 8000000,
                'side_income' => 2000000,
                'npwp' => '12.345.678.9-123.000',

                'spouse_name' => 'Siti Aisyah',
                'spouse_nik' => '3276010101010002',
                'father_name' => 'Budi Santoso',
                'mother_name' => 'Ani Wulandari',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 'CUST-002',
                'full_name' => 'Rina Kartika',
                'nickname' => 'Rina',
                'nik' => 3174010101010003,
                'no_kk' => 3174010101010000,
                'birthplace' => 'Jakarta',
                'date_birth' => '1995-03-12',
                'age' => 31,
                'gender' => 'Perempuan',
                'religion' => 'Islam',
                'nationality' => 'WNI',
                'marital_status' => 'Belum Menikah',
                'marital_date' => null,
                'child_count' => 0,

                'province' => 'DKI Jakarta',
                'city' => 'Jakarta Selatan',
                'subdistrict' => 'Tebet',
                'village' => 'Tebet Barat',
                'rt' => '02',
                'rw' => '03',
                'postal_code' => 12810,
                'address' => 'Jl. Tebet Raya No. 45',

                'domicile_province' => 'DKI Jakarta',
                'domicile_city' => 'Jakarta Selatan',
                'domicile_subdistrict' => 'Tebet',
                'domicile_village' => 'Tebet Barat',
                'domicile_rt' => '02',
                'domicile_rw' => '03',
                'domicile_postal_code' => 12810,
                'domicile_address' => 'Jl. Tebet Raya No. 45',

                'phone' => '081298765432',
                'home_phone' => null,
                'email' => 'rina@example.com',
                'office_email' => null,

                'instagram' => '@rinakartika',
                'facebook' => 'rina.kartika',
                'tiktok' => '@rinatk',
                'x' => '@rinax',

                'job_status' => 'Wiraswasta',
                'job_status_lainnya' => null,
                'company_name' => 'Rina Boutique',
                'main_income' => 12000000,
                'side_income' => 3000000,
                'npwp' => '98.765.432.1-987.000',

                'spouse_name' => null,
                'spouse_nik' => null,
                'father_name' => 'Hendra Wijaya',
                'mother_name' => 'Lina Marlina',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}