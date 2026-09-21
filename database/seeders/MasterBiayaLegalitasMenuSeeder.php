<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MasterBiayaLegalitasMenuSeeder extends Seeder
{
    public function run(): void
    {
        $master = Menu::where('name', 'Master Data')->first();
        if ($master) {
            $menu = Menu::firstOrCreate(
                ['route' => 'master.biaya-legalitas.index'],
                [
                    'name' => 'Master Biaya Legalitas & Admin',
                    'parent_id' => $master->id,
                    'icon' => 'mdi-cash-multiple',
                    'order' => 2
                ]
            );

            // Sync with all positions that can access Master Data
            $positions = $master->positions()->pluck('positions.id')->toArray();
            if (!empty($positions)) {
                $menu->positions()->syncWithoutDetaching($positions);
            }
        }
    }
}
