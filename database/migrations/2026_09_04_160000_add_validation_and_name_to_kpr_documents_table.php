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
        Schema::table('kpr_documents', function (Blueprint $table) {
            if (!Schema::hasColumn('kpr_documents', 'document_name')) {
                $table->string('document_name')->nullable()->after('type');
            }
            if (!Schema::hasColumn('kpr_documents', 'status')) {
                $table->string('status')->default('pending')->after('path'); // pending, disetujui, revisi, ditolak
            }
            if (!Schema::hasColumn('kpr_documents', 'catatan')) {
                $table->text('catatan')->nullable()->after('status');
            }
            if (!Schema::hasColumn('kpr_documents', 'validated_by')) {
                $table->unsignedBigInteger('validated_by')->nullable()->after('catatan');
            }
            if (!Schema::hasColumn('kpr_documents', 'validated_at')) {
                $table->timestamp('validated_at')->nullable()->after('validated_by');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kpr_documents', function (Blueprint $table) {
            $table->dropColumn(['document_name', 'status', 'catatan', 'validated_by', 'validated_at']);
        });
    }
};
