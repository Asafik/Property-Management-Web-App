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
                'name' => 'Budi Santoso',
                'username' => 'budi',
                'password' => Hash::make('password'),
                'division_id' => 1,
                'position_id' => 1,
                'phone' => '08123456789',
                'address' => 'Jember'
            ],
            [
                'name' => 'Siti Rahma',
                'username' => 'siti',
                'password' => Hash::make('password'),
                'division_id' => 2,
                'position_id' => 3,
                'phone' => '08123456788',
                'address' => 'Bondowoso'
            ],
            [
                'name' => 'Ahmad Fauzi',
                'username' => 'ahmad',
                'password' => Hash::make('password'),
                'division_id' => 4,
                'position_id' => 3,
                'phone' => '08123456787',
                'address' => 'Situbondo'
            ],
        ]);
    }
}
