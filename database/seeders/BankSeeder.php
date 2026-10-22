<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banks; 
use Carbon\Carbon;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            [
                'bank_name' => 'BCA',
                'is_active' => true,
                'account_holder' => 'PT Griya Ainaya Sejahtera',
                'number' => '1234567890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bank_name' => 'MANDIRI',
                'is_active' => true,
                'account_holder' => 'PT Griya Ainaya Sejahtera',
                'number' => '123-00-1234567-8',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bank_name' => 'BRI',
                'is_active' => true,
                'account_holder' => 'PT Griya Ainaya Sejahtera',
                'number' => '1234-01-123456-7',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bank_name' => 'BNI',
                'is_active' => true,
                'account_holder' => 'PT Griya Ainaya Sejahtera',
                'number' => '1234567890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bank_name' => 'CIMB NIAGA',
                'is_active' => false,
                'account_holder' => null,
                'number' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bank_name' => 'DANAMON',
                'is_active' => false,
                'account_holder' => null,
                'number' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bank_name' => 'PERMATA',
                'is_active' => false,
                'account_holder' => null,
                'number' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bank_name' => 'BSI',
                'is_active' => true,
                'account_holder' => 'PT Griya Ainaya Sejahtera',
                'number' => '1234567890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bank_name' => 'MAYBANK',
                'is_active' => false,
                'account_holder' => null,
                'number' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bank_name' => 'PANIN',
                'is_active' => false,
                'account_holder' => null,
                'number' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($banks as $bank) {
            Banks::create($bank);
        }
    }
}
