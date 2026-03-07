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
    Schema::table('bookings', function (Blueprint $table) {
        $table->date('dp_date')->nullable()->after('booking_date');
        $table->date('pelunasan_date')->nullable()->after('dp_date');
        $table->date('akad_date')->nullable()->after('pelunasan_date');
        $table->date('serah_terima_date')->nullable()->after('akad_date');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
