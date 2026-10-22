<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanySetting;
use Carbon\Carbon;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanySetting::create([
            'company_name' => 'PT Griya Ainaya Sejahtera',
            'npwp' => '01.234.567.8-999.999',
            'address' => 'Jl. Gajah Mada No. 123, Kec. Sumbersari',
            'city' => 'Jember',
            'province' => 'Jawa Timur',
            'postal_code' => '68121',
            'phone' => '1234567',
            'whatsapp' => '081234567899',
            'email' => 'info@griyainaya.com',
            'website' => 'www.griyainaya.com',
            'founded_date' => Carbon::create(2015, 5, 15)->toDateString(),
            'logo' => null,
            'favicon' => null,
        ]);
    }
}
