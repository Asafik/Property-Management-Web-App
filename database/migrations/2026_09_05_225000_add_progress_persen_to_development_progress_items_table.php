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
        if (Schema::hasTable('development_progress_items')) {
            Schema::table('development_progress_items', function (Blueprint $table) {
                if (!Schema::hasColumn('development_progress_items', 'progress_persen')) {
                    $table->unsignedTinyInteger('progress_persen')->default(0)->after('keterangan');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('development_progress_items')) {
            Schema::table('development_progress_items', function (Blueprint $table) {
                if (Schema::hasColumn('development_progress_items', 'progress_persen')) {
                    $table->dropColumn('progress_persen');
                }
            });
        }
    }
};
