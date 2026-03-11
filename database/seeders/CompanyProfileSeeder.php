<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;
use Carbon\Carbon;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'PT Griya Ainaya Sejahtera',
                'address' => 'Jl. Gajah Mada No. 123, Kec. Sumbersari, Jember, Jawa Timur 68121',
                'phone' => '081234567899',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'PT Properti Management Jaya',
                'address' => 'Jl. Sudirman No. 45, Jakarta Pusat, DKI Jakarta 10210',
                'phone' => '0211234567',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'CV Bangun Bersama',
                'address' => 'Jl. Diponegoro No. 78, Surabaya, Jawa Timur 60241',
                'phone' => '0319876543',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'PT Graha Indah Property',
                'address' => 'Jl. Gatot Subroto No. 100, Bandung, Jawa Barat 40123',
                'phone' => '0225556667',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'PT Mitra Sejati Properti',
                'address' => 'Jl. Malioboro No. 56, Yogyakarta 55122',
                'phone' => '0274888999',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'PT Karya Abadi Property',
                'address' => 'Jl. Teuku Umar No. 34, Denpasar, Bali 80235',
                'phone' => '0361777888',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'PT Alam Indah Properti',
                'address' => 'Jl. Pemuda No. 67, Semarang, Jawa Tengah 50132',
                'phone' => '0244445556',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'PT Bumi Pertiwi Property',
                'address' => 'Jl. Jendral Ahmad Yani No. 89, Medan, Sumatera Utara 20111',
                'phone' => '0618889999',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'CV Sukses Makmur Properti',
                'address' => 'Jl. Pahlawan No. 23, Makassar, Sulawesi Selatan 90123',
                'phone' => '0411666777',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'PT Nusantara Property Group',
                'address' => 'Jl. Merdeka No. 12, Palembang, Sumatera Selatan 30123',
                'phone' => '0711555666',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($companies as $company) {
            CompanyProfile::create($company);
        }
    }
}
