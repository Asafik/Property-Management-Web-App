<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
//     public function up(): void
// {
//     Schema::table('promos', function (Blueprint $table) {

//         // Hapus kolom lama
//         $table->dropColumn('value');

//         // Tambah kolom baru yang jelas tipe datanya
//         $table->decimal('value_nominal', 15, 2)->nullable();
//         $table->integer('value_percent')->nullable();
//         $table->string('value_text')->nullable();

//     });
// }

public function up(): void
{
    Schema::table('promos', function (Blueprint $table) {

        // cek dulu sebelum drop
        if (Schema::hasColumn('promos', 'value')) {
            $table->dropColumn('value');
        }

        // kolom baru
        $table->decimal('value_nominal', 15, 2)->nullable();
        $table->integer('value_percent')->nullable();
        $table->string('value_text')->nullable();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('promos', function (Blueprint $table) {

        $table->dropColumn(['value_nominal','value_percent','value_text']);
        $table->string('value')->nullable();

    });
}
};
