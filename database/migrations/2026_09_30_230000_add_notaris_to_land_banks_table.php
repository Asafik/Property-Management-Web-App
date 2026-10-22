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
        Schema::table('land_banks', function (Blueprint $table) {
            if (!Schema::hasColumn('land_banks', 'notaris_id')) {
                $table->foreignId('notaris_id')->nullable()->constrained('notaris')->nullOnDelete()->after('shgb_induk_file');
            }
            if (!Schema::hasColumn('land_banks', 'notaris_name')) {
                $table->string('notaris_name')->nullable()->after('notaris_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('land_banks', function (Blueprint $table) {
            if (Schema::hasColumn('land_banks', 'notaris_id')) {
                $table->dropForeign(['notaris_id']);
                $table->dropColumn('notaris_id');
            }
            if (Schema::hasColumn('land_banks', 'notaris_name')) {
                $table->dropColumn('notaris_name');
            }
        });
    }
};
