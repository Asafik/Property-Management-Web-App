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
                'name' => 'Kepala Marketing',
                'division_id' => 1
            ],
             [
                'name' => 'Staff Marketing',
                'division_id' => 1
            ],
            [
                'name' => 'Kepala Legal',
                'division_id' => 2
            ],
            [
                'name' => 'Staff Legal',
                'division_id' => 2
            ],
            [
                'name' => 'Admin',
                'division_id' => 4
            ],
        ]);
    }
}