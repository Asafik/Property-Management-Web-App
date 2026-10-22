<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Position;
use Illuminate\Database\Seeder;

class DokumenPerizinanMenuSeeder extends Seeder
{
    public function run(): void
    {
        $master = Menu::where('name', 'Master Data')->first();
        if ($master) {
            $menu = Menu::firstOrCreate(
                ['route' => 'master.dokumen-perizinan.index'],
                [
                    'name' => 'Master Dokumen Perizinan',
                    'parent_id' => $master->id,
                    'icon' => 'mdi-file-certificate-outline',
                    'order' => 1
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
