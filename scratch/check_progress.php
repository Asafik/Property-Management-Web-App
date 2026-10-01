<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$unit = \App\Models\LandBankUnit::find(1);
echo "Unit: " . ($unit ? $unit->unit_code : 'null') . "\n";
$dp = \App\Models\DevelopmentProgress::where('land_bank_unit_id', 1)->first();
echo "DP: " . ($dp ? $dp->id : 'null') . "\n";
if ($dp) {
    echo "Items count: " . $dp->items()->count() . "\n";
    foreach ($dp->items as $item) {
        echo " - [{$item->kategori}] {$item->uraian} (vol: {$item->volume} {$item->satuan}, prog: {$item->progress_persen}%)\n";
    }
    echo "Opname count: " . \App\Models\OpnameMingguan::where('development_progress_id', $dp->id)->count() . "\n";
    echo "Termin count: " . \App\Models\PembayaranTermin::where('development_progress_id', $dp->id)->count() . "\n";
}
