<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_commission_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. Komisi Standar Komersil 2.5%, Komisi Subsidi Flat Rp 4.000.000
            $table->foreignId('land_bank_id')->nullable()->constrained('land_banks')->nullOnDelete(); // null = Semua Proyek
            $table->string('target_type')->default('all'); // 'all', 'subsidi', 'komersil'
            $table->string('calculation_type')->default('percentage'); // 'percentage', 'fixed'
            $table->decimal('value', 15, 2); // 2.50 atau 4000000.00
            $table->decimal('min_price', 15, 2)->nullable();
            $table->decimal('max_price', 15, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default initial rules
        DB::table('agent_commission_rules')->insert([
            [
                'name' => 'Komisi Standar Unit Komersil (2.5%)',
                'land_bank_id' => null,
                'target_type' => 'komersil',
                'calculation_type' => 'percentage',
                'value' => 2.50,
                'min_price' => null,
                'max_price' => null,
                'is_active' => true,
                'description' => 'Komisi default 2.5% dari harga jual untuk seluruh unit komersil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Komisi Standar Unit Subsidi (Rp 3.500.000)',
                'land_bank_id' => null,
                'target_type' => 'subsidi',
                'calculation_type' => 'fixed',
                'value' => 3500000.00,
                'min_price' => null,
                'max_price' => null,
                'is_active' => true,
                'description' => 'Komisi nominal flat Rp 3.500.000 untuk seluruh unit subsidi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('agent_commission_rules');
    }
};
