<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pra_landbanks', function (Blueprint $table) {
            if (!Schema::hasColumn('pra_landbanks', 'photo_2')) {
                $table->string('photo_2')->nullable()->after('photo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pra_landbanks', function (Blueprint $table) {
            if (Schema::hasColumn('pra_landbanks', 'photo_2')) {
                $table->dropColumn('photo_2');
            }
        });
    }
};
