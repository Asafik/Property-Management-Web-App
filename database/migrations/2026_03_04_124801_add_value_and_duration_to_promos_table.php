<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            if (!Schema::hasColumn('promos', 'value')) {
                $table->decimal('value', 15, 2)->after('category')->nullable();
            }
            if (!Schema::hasColumn('promos', 'duration_days')) {
                $table->integer('duration_days')->after('end_date')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            if (Schema::hasColumn('promos', 'value')) {
                $table->dropColumn('value');
            }
            if (Schema::hasColumn('promos', 'duration_days')) {
                $table->dropColumn('duration_days');
            }
        });
    }
};