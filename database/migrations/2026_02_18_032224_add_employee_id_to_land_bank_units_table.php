<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeIdToLandBankUnitsTable extends Migration
{
    public function up()
    {
        Schema::table('land_bank_units', function (Blueprint $table) {

            $table->foreignId('employee_id')
                  ->nullable()
                  ->after('customer_id') // opsional, sesuaikan posisi
                  ->constrained('employees')
                  ->nullOnDelete();

        });
    }

    public function down()
    {
        Schema::table('land_bank_units', function (Blueprint $table) {

            $table->dropForeign(['employee_id']);
            $table->dropColumn('employee_id');

        });
    }
}
