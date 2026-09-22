<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Position;

class PerizinanMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $allPositionIds = Position::pluck('id')->toArray();

        // Hapus submenu perizinan sebelumnya jika ada agar sidebar tidak bercabang
        $children = Menu::whereIn('route', ['perizinan.cards', 'perizinan.project'])->get();
        foreach ($children as $c) {
            $c->positions()->detach();
            $c->delete();
        }

        // Cari atau buat Menu Utama "Perizinan"
        $menu = Menu::where('name', 'Perizinan')
            ->whereNull('parent_id')
            ->first();

        if ($menu) {
            // Hapus children jika ada
            $existingSubs = Menu::where('parent_id', $menu->id)->get();
            foreach ($existingSubs as $es) {
                $es->positions()->detach();
                $es->delete();
            }

            $menu->update([
                'name'      => 'Perizinan',
                'route'     => 'perizinan.index',
                'icon'      => 'mdi-file-certificate-outline',
                'order'     => 4,
                'parent_id' => null,
            ]);
        } else {
            $menu = Menu::updateOrCreate(
                ['route' => 'perizinan.index'],
                [
                    'name'      => 'Perizinan',
                    'icon'      => 'mdi-file-certificate-outline',
                    'order'     => 4,
                    'parent_id' => null,
                ]
            );
        }

        if (!empty($allPositionIds)) {
            $menu->positions()->sync($allPositionIds);
        }
    }
}
