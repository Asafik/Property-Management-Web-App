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
        Schema::table('pra_landbank_payments', function (Blueprint $table) {
            if (!Schema::hasColumn('pra_landbank_payments', 'payment_type')) {
                $table->string('payment_type')->nullable()->after('amount'); // 'transfer' or 'cash'
            }
            if (!Schema::hasColumn('pra_landbank_payments', 'bank_name')) {
                $table->string('bank_name')->nullable()->after('payment_type');
            }
            if (!Schema::hasColumn('pra_landbank_payments', 'account_number')) {
                $table->string('account_number')->nullable()->after('bank_name');
            }
            if (!Schema::hasColumn('pra_landbank_payments', 'account_name')) {
                $table->string('account_name')->nullable()->after('account_number');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pra_landbank_payments', function (Blueprint $table) {
            $table->dropColumn(['payment_type', 'bank_name', 'account_number', 'account_name']);
        });
    }
};
