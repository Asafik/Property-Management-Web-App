<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('employees')->insert([
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'password' => Hash::make('superpassword'),
                'address' => 'Jl. Super Admin No.1',
                'role' => 'superadmin',
                'phone' => '081234567890',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => Hash::make('adminpassword'),
                'address' => 'Jl. Admin No.2',
                'role' => 'admin',
                'phone' => '081298765432',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Agency One',
                'username' => 'agency1',
                'password' => Hash::make('agencypass1'),
                'address' => 'Jl. Agency No.3',
                'role' => 'agency',
                'phone' => '081211122233',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Agency Two',
                'username' => 'agency2',
                'password' => Hash::make('agencypass2'),
                'address' => 'Jl. Agency No.4',
                'role' => 'agency',
                'phone' => '081244455566',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
