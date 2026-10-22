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
            if (!Schema::hasColumn('land_banks', 'custom_workflow_docs')) {
                $table->json('custom_workflow_docs')->nullable()->after('description');
            }
            if (!Schema::hasColumn('land_banks', 'desa_reg_no')) {
                $table->string('desa_reg_no')->nullable()->after('custom_workflow_docs');
                $table->date('desa_reg_date')->nullable()->after('desa_reg_no');
                $table->string('desa_doc_file')->nullable()->after('desa_reg_date');
            }
            if (!Schema::hasColumn('land_banks', 'pertek_no')) {
                $table->string('pertek_no')->nullable()->after('desa_doc_file');
                $table->date('pertek_date')->nullable()->after('pertek_no');
                $table->string('pertek_file')->nullable()->after('pertek_date');
            }
            if (!Schema::hasColumn('land_banks', 'peta_bidang_no')) {
                $table->string('peta_bidang_no')->nullable()->after('pertek_file');
                $table->date('peta_bidang_date')->nullable()->after('peta_bidang_no');
                $table->decimal('peta_bidang_area', 12, 2)->nullable()->after('peta_bidang_date');
                $table->string('peta_bidang_file')->nullable()->after('peta_bidang_area');
            }
            if (!Schema::hasColumn('land_banks', 'pkkpr_no')) {
                $table->string('pkkpr_no')->nullable()->after('peta_bidang_file');
                $table->date('pkkpr_date')->nullable()->after('pkkpr_no');
                $table->string('pkkpr_status')->nullable()->after('pkkpr_date');
                $table->string('pkkpr_file')->nullable()->after('pkkpr_status');
            }
            if (!Schema::hasColumn('land_banks', 'sk_hgb_no')) {
                $table->string('sk_hgb_no')->nullable()->after('pkkpr_file');
                $table->date('sk_hgb_date')->nullable()->after('sk_hgb_no');
                $table->string('sk_hgb_file')->nullable()->after('sk_hgb_date');
            }
            if (!Schema::hasColumn('land_banks', 'shgb_induk_no')) {
                $table->string('shgb_induk_no')->nullable()->after('sk_hgb_file');
                $table->date('shgb_induk_date')->nullable()->after('shgb_induk_no');
                $table->decimal('shgb_induk_area', 12, 2)->nullable()->after('shgb_induk_date');
                $table->string('shgb_induk_file')->nullable()->after('shgb_induk_area');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('land_banks', function (Blueprint $table) {
            $columns = [
                'custom_workflow_docs',
                'desa_reg_no', 'desa_reg_date', 'desa_doc_file',
                'pertek_no', 'pertek_date', 'pertek_file',
                'peta_bidang_no', 'peta_bidang_date', 'peta_bidang_area', 'peta_bidang_file',
                'pkkpr_no', 'pkkpr_date', 'pkkpr_status', 'pkkpr_file',
                'sk_hgb_no', 'sk_hgb_date', 'sk_hgb_file',
                'shgb_induk_no', 'shgb_induk_date', 'shgb_induk_area', 'shgb_induk_file'
            ];
            foreach ($columns as $col) {
                if (Schema::hasColumn('land_banks', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
