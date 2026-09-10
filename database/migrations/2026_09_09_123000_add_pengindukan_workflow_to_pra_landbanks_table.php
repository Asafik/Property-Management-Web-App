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
        Schema::table('pra_landbanks', function (Blueprint $table) {
            // Poin 7: Blangko Kelurahan & Kecamatan
            if (!Schema::hasColumn('pra_landbanks', 'desa_reg_no')) {
                $table->string('desa_reg_no')->nullable()->after('release_deed_file');
                $table->date('desa_reg_date')->nullable()->after('desa_reg_no');
                $table->string('desa_doc_file')->nullable()->after('desa_reg_date');
                $table->string('kecamatan_reg_no')->nullable()->after('desa_doc_file');
                $table->date('kecamatan_reg_date')->nullable()->after('kecamatan_reg_no');
                $table->string('kecamatan_doc_file')->nullable()->after('kecamatan_reg_date');
            }

            // Poin 8 & 9: PERTEK ATR/BPN & Peta Bidang
            if (!Schema::hasColumn('pra_landbanks', 'pertek_no')) {
                $table->string('pertek_no')->nullable()->after('kecamatan_doc_file');
                $table->date('pertek_date')->nullable()->after('pertek_no');
                $table->string('pertek_file')->nullable()->after('pertek_date');

                $table->string('peta_bidang_no')->nullable()->after('pertek_file');
                $table->date('peta_bidang_date')->nullable()->after('peta_bidang_no');
                $table->decimal('peta_bidang_area', 15, 2)->nullable()->after('peta_bidang_date');
                $table->string('peta_bidang_file')->nullable()->after('peta_bidang_area');
            }

            // Poin 10: PKKPR / OSS RBA & Polygon SHP
            if (!Schema::hasColumn('pra_landbanks', 'pkkpr_no')) {
                $table->string('pkkpr_no')->nullable()->after('peta_bidang_file');
                $table->date('pkkpr_date')->nullable()->after('pkkpr_no');
                $table->string('pkkpr_status', 30)->nullable()->default('proses')->after('pkkpr_date'); // proses, terbit, ditolak
                $table->string('pkkpr_file')->nullable()->after('pkkpr_status');
                $table->string('polygon_shp_file')->nullable()->after('pkkpr_file');
            }

            // Poin 11 s/d 16: SK HGB, Mutasi PBB Bapenda, & BPHTB
            if (!Schema::hasColumn('pra_landbanks', 'sk_hgb_no')) {
                $table->string('sk_hgb_no')->nullable()->after('polygon_shp_file');
                $table->date('sk_hgb_date')->nullable()->after('sk_hgb_no');
                $table->string('sk_hgb_file')->nullable()->after('sk_hgb_date');

                $table->string('pbb_mutasi_nop')->nullable()->after('sk_hgb_file');
                $table->date('pbb_mutasi_date')->nullable()->after('pbb_mutasi_nop');
                $table->string('pbb_mutasi_file')->nullable()->after('pbb_mutasi_date');

                $table->decimal('bphtb_nominal', 18, 2)->nullable()->after('pbb_mutasi_file');
                $table->date('bphtb_payment_date')->nullable()->after('bphtb_nominal');
                $table->string('bphtb_billing_id')->nullable()->after('bphtb_payment_date');
                $table->string('bphtb_validasi_file')->nullable()->after('bphtb_billing_id');
                $table->string('bphtb_approval_status', 30)->nullable()->default('pending')->after('bphtb_validasi_file');
            }

            // Poin 17: SHGB Induk Selesai an. PT & Linking Pasca Land Bank
            if (!Schema::hasColumn('pra_landbanks', 'shgb_induk_no')) {
                $table->string('shgb_induk_no')->nullable()->after('bphtb_approval_status');
                $table->date('shgb_induk_date')->nullable()->after('shgb_induk_no');
                $table->decimal('shgb_induk_area', 15, 2)->nullable()->after('shgb_induk_date');
                $table->string('shgb_induk_file')->nullable()->after('shgb_induk_area');
                $table->foreignId('land_bank_id')->nullable()->constrained('land_banks')->nullOnDelete()->after('shgb_induk_file');
                $table->string('hgb_process_status', 30)->nullable()->default('draft')->after('land_bank_id'); // draft, in_progress, completed_hgb_induk
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pra_landbanks', function (Blueprint $table) {
            $columns = [
                'desa_reg_no', 'desa_reg_date', 'desa_doc_file',
                'kecamatan_reg_no', 'kecamatan_reg_date', 'kecamatan_doc_file',
                'pertek_no', 'pertek_date', 'pertek_file',
                'peta_bidang_no', 'peta_bidang_date', 'peta_bidang_area', 'peta_bidang_file',
                'pkkpr_no', 'pkkpr_date', 'pkkpr_status', 'pkkpr_file', 'polygon_shp_file',
                'sk_hgb_no', 'sk_hgb_date', 'sk_hgb_file',
                'pbb_mutasi_nop', 'pbb_mutasi_date', 'pbb_mutasi_file',
                'bphtb_nominal', 'bphtb_payment_date', 'bphtb_billing_id', 'bphtb_validasi_file', 'bphtb_approval_status',
                'shgb_induk_no', 'shgb_induk_date', 'shgb_induk_area', 'shgb_induk_file', 'land_bank_id', 'hgb_process_status'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('pra_landbanks', $column)) {
                    if ($column === 'land_bank_id') {
                        $table->dropForeign(['land_bank_id']);
                    }
                    $table->dropColumn($column);
                }
            }
        });
    }
};
