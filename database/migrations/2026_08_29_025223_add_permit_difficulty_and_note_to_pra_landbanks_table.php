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
            if (!Schema::hasColumn('pra_landbanks', 'permit_difficulty')) {
                $table->string('permit_difficulty')->nullable()->after('zoning');
            }
            if (!Schema::hasColumn('pra_landbanks', 'permit_difficulty_note')) {
                $table->text('permit_difficulty_note')->nullable()->after('permit_difficulty');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pra_landbanks', function (Blueprint $table) {
            if (Schema::hasColumn('pra_landbanks', 'permit_difficulty_note')) {
                $table->dropColumn('permit_difficulty_note');
            }
        });
    }
};
