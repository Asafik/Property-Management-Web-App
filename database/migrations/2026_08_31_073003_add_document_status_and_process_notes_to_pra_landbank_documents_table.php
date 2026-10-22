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
            $table->string('document_status')->default('ada')->after('document_number'); // ada, proses, belum_ada
            $table->text('process_notes')->nullable()->after('document_status'); // Keterangan jika status proses
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pra_landbank_documents', function (Blueprint $table) {
            $table->dropColumn(['document_status', 'process_notes']);
        });
    }
};
