<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pra_landbanks', function (Blueprint $table) {
            if (!Schema::hasColumn('pra_landbanks', 'pbb_note')) {
                $table->string('pbb_note', 255)->nullable()->after('pbb_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pra_landbanks', function (Blueprint $table) {
            if (Schema::hasColumn('pra_landbanks', 'pbb_note')) {
                $table->dropColumn('pbb_note');
            }
        });
    }
};
