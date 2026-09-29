<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);


    // }

    public function run(): void
    {
        $this->call([
            DivisionSeeder::class,
            PositionSeeder::class,
            EmployeeSeeder::class,
            MenuSeeder::class,
            CompanyProfileSeeder::class,
            CompanySettingSeeder::class,
            BankSeeder::class,
            NotarisSeeder::class,
            DocumentTypeSeeder::class,
            MasterDokumenPerizinanSeeder::class,
            MasterBiayaLegalitasSeeder::class,
            DevelopmentProgressItemsSeeder::class,
            PromoSeeder::class,
            // PraLandbankDocumentSeeder::class,
            // LandBankUnitSeeder::class,     // Dikeluarkan: seeder dummy tanah pasca
            // PerizinanTaskSeeder::class,    // Dikeluarkan: seeder dummy tugas tanah perizinan
        ]);
    }
}
