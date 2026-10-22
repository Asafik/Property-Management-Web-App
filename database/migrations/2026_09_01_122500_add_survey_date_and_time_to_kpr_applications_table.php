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
        Schema::table('kpr_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('kpr_applications', 'survey_date')) {
                $table->date('survey_date')->nullable()->after('catatan');
            }
            if (!Schema::hasColumn('kpr_applications', 'survey_time')) {
                $table->time('survey_time')->nullable()->after('survey_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kpr_applications', function (Blueprint $table) {
            if (Schema::hasColumn('kpr_applications', 'survey_time')) {
                $table->dropColumn('survey_time');
            }
            if (Schema::hasColumn('kpr_applications', 'survey_date')) {
                $table->dropColumn('survey_date');
            }
        });
    }
};
