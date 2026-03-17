<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        Employee::insert([
            [
                'name' => 'Kepala Marketing',
                'username' => 'Kepala Marketing',
                'password' => Hash::make('password'),
                'division_id' => 1,
                'position_id' => 1,
                'phone' => '08123456789',
                'address' => 'Jember'
            ],
            [
                'name' => 'Kepala Legal',
                'username' => 'Kepala Legal',
                'password' => Hash::make('password'),
                'division_id' => 2,
                'position_id' => 2,
                'phone' => '08123456788',
                'address' => 'Bondowoso'
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'division_id' => 4,
                'position_id' => 5,
                'phone' => '08123456787',
                'address' => 'Situbondo'
            ],
            [
                'name' => 'Staff Marketing',
                'username' => 'marketing',
                'password' => Hash::make('password'),
                'division_id' => 2,
                'position_id' => 2,
                'phone' => '08123456789',
                'address' => 'Jember'
            ]
        ]);
    }
}
