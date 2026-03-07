<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        Division::insert([
            ['name' => 'Marketing'],
            ['name' => 'Finance'],
            ['name' => 'HRD'],
            ['name' => 'Project'],
            ['name' => 'Legal'],
        ]);
    }
}