<?php
// Script untuk fix FK dibuat_oleh di opname_mingguan dan pembayaran_termin
// dari tabel users ke employees

require dirname(__DIR__) . '/vendor/autoload.php';
$app = require dirname(__DIR__) . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== Fix FK dibuat_oleh: users -> employees ===\n";

// Cek constraint yang ada
$constraints = DB::select("
    SELECT CONSTRAINT_NAME, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME
    FROM information_schema.KEY_COLUMN_USAGE 
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME IN ('opname_mingguan', 'pembayaran_termin')
    AND REFERENCED_TABLE_NAME IS NOT NULL
");

echo "Existing FKs:\n";
foreach ($constraints as $c) {
    echo "  [{$c->TABLE_NAME}] {$c->CONSTRAINT_NAME}: {$c->COLUMN_NAME} -> {$c->REFERENCED_TABLE_NAME}\n";
}

// Drop FK lama di opname_mingguan yang ke users
$opnameFKs = DB::select("
    SELECT CONSTRAINT_NAME
    FROM information_schema.KEY_COLUMN_USAGE 
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'opname_mingguan'
    AND COLUMN_NAME IN ('dibuat_oleh', 'disetujui_oleh')
    AND REFERENCED_TABLE_NAME = 'users'
");

foreach ($opnameFKs as $fk) {
    echo "Dropping FK: {$fk->CONSTRAINT_NAME} from opname_mingguan...\n";
    DB::statement("ALTER TABLE `opname_mingguan` DROP FOREIGN KEY `{$fk->CONSTRAINT_NAME}`");
}

// Buat FK baru ke employees (jika belum ada)
$existingNewFKs = DB::select("
    SELECT CONSTRAINT_NAME
    FROM information_schema.KEY_COLUMN_USAGE 
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'opname_mingguan'
    AND COLUMN_NAME = 'dibuat_oleh'
    AND REFERENCED_TABLE_NAME = 'employees'
");

if (empty($existingNewFKs)) {
    echo "Adding new FK: opname_mingguan.dibuat_oleh -> employees.id\n";
    DB::statement("ALTER TABLE `opname_mingguan` ADD CONSTRAINT `opname_mingguan_dibuat_oleh_employees_fk` FOREIGN KEY (`dibuat_oleh`) REFERENCES `employees`(`id`) ON DELETE SET NULL");
}

$existingNewFKsDis = DB::select("
    SELECT CONSTRAINT_NAME
    FROM information_schema.KEY_COLUMN_USAGE 
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'opname_mingguan'
    AND COLUMN_NAME = 'disetujui_oleh'
    AND REFERENCED_TABLE_NAME = 'employees'
");

if (empty($existingNewFKsDis)) {
    // Check if disetujui_oleh FK exists pointing to users
    $disFKs = DB::select("
        SELECT CONSTRAINT_NAME
        FROM information_schema.KEY_COLUMN_USAGE 
        WHERE TABLE_SCHEMA = DATABASE()
        AND TABLE_NAME = 'opname_mingguan'
        AND COLUMN_NAME = 'disetujui_oleh'
        AND REFERENCED_TABLE_NAME = 'users'
    ");
    foreach ($disFKs as $fk) {
        echo "Dropping FK: {$fk->CONSTRAINT_NAME} from opname_mingguan...\n";
        DB::statement("ALTER TABLE `opname_mingguan` DROP FOREIGN KEY `{$fk->CONSTRAINT_NAME}`");
    }
    echo "Adding new FK: opname_mingguan.disetujui_oleh -> employees.id\n";
    DB::statement("ALTER TABLE `opname_mingguan` ADD CONSTRAINT `opname_mingguan_disetujui_oleh_employees_fk` FOREIGN KEY (`disetujui_oleh`) REFERENCES `employees`(`id`) ON DELETE SET NULL");
}

// Same for pembayaran_termin
$terminFKsUsers = DB::select("
    SELECT CONSTRAINT_NAME, COLUMN_NAME
    FROM information_schema.KEY_COLUMN_USAGE 
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'pembayaran_termin'
    AND COLUMN_NAME IN ('dibayar_oleh', 'disetujui_oleh')
    AND REFERENCED_TABLE_NAME = 'users'
");

foreach ($terminFKsUsers as $fk) {
    echo "Dropping FK: {$fk->CONSTRAINT_NAME} from pembayaran_termin ({$fk->COLUMN_NAME})...\n";
    DB::statement("ALTER TABLE `pembayaran_termin` DROP FOREIGN KEY `{$fk->CONSTRAINT_NAME}`");
    echo "Adding new FK for {$fk->COLUMN_NAME} -> employees...\n";
    DB::statement("ALTER TABLE `pembayaran_termin` ADD CONSTRAINT `pembayaran_termin_{$fk->COLUMN_NAME}_employees_fk` FOREIGN KEY (`{$fk->COLUMN_NAME}`) REFERENCES `employees`(`id`) ON DELETE SET NULL");
}

echo "\n=== Done! ===\n";
