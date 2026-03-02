<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Tambahkan kolom status untuk masing-masing tahapan
            $table->enum('status_cash', ['pending', 'process', 'done'])->default('pending')->after('purchase_type');
            $table->enum('status_akad', ['pending', 'done','cancelled'])->default('pending')->after('status_cash');
            $table->enum('status_legal', ['pending', 'done','cancelled'])->default('pending')->after('status_akad');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['status_cash', 'status_akad', 'status_legal']);
        });
    }
};