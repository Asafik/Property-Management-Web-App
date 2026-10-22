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
        if (Schema::hasTable('development_progress')) {
            Schema::table('development_progress', function (Blueprint $table) {
                if (!Schema::hasColumn('development_progress', 'checklist_kondisi')) {
                    $table->json('checklist_kondisi')->nullable()->after('total_anggaran');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('development_progress')) {
            Schema::table('development_progress', function (Blueprint $table) {
                if (Schema::hasColumn('development_progress', 'checklist_kondisi')) {
                    $table->dropColumn('checklist_kondisi');
                }
            });
        }
    }
};
