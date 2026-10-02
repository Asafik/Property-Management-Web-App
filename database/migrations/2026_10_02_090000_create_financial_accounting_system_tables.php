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
        // 1. Chart of Accounts (Bagan Akun Standar Developer Properti)
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name', 150);
            $table->enum('category', ['asset', 'liability', 'equity', 'revenue', 'cogs', 'expense']);
            $table->string('sub_category', 100);
            $table->enum('normal_balance', ['debit', 'credit'])->default('debit');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Journal Entries (Kepala Jurnal & Voucher Kas)
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->string('entry_number', 50)->unique();
            $table->date('entry_date');
            $table->enum('transaction_type', ['inflow', 'outflow', 'general'])->default('general');
            $table->enum('cash_flow_category', ['operating', 'investing', 'financing', 'none'])->default('none');
            $table->string('source_module', 50)->default('manual');
            $table->string('reference_type', 100)->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->foreignId('land_bank_id')->nullable()->constrained('land_banks')->nullOnDelete();
            $table->text('description');
            $table->string('party_name', 150)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->string('proof_file')->nullable();
            $table->boolean('is_auto_generated')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['source_module', 'reference_id']);
            $table->index('entry_date');
        });

        // 3. Journal Entry Items (Detail Baris Debit & Kredit)
        Schema::create('journal_entry_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_entry_id')->constrained('journal_entries')->cascadeOnDelete();
            $table->foreignId('account_id')->constrained('chart_of_accounts')->cascadeOnDelete();
            $table->enum('type', ['debit', 'credit']);
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('memo', 255)->nullable();
            $table->timestamps();

            $table->index(['journal_entry_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entry_items');
        Schema::dropIfExists('journal_entries');
        Schema::dropIfExists('chart_of_accounts');
    }
};
