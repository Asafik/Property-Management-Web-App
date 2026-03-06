<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        Position::insert([
            [
                'name' => 'Manager',
                'division_id' => 1
            ],
            [
                'name' => 'Supervisor',
                'division_id' => 1
            ],
            [
                'name' => 'Staff',
                'division_id' => 2
            ],
            [
                'name' => 'Admin',
                'division_id' => 3
            ],
        ]);
    }
}