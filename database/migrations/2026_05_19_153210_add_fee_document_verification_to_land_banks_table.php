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
            $table->decimal('fee_document_verification', 15, 2)->nullable()->after('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('land_banks', function (Blueprint $table) {
            $table->dropColumn('fee_document_verification');
        });
    }
};
