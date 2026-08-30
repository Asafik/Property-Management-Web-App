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
        Schema::table('pra_landbank_documents', function (Blueprint $table) {
            $table->text('admin_notes')->nullable()->after('revision_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pra_landbank_documents', function (Blueprint $table) {
            $table->dropColumn('admin_notes');
        });
    }
};
