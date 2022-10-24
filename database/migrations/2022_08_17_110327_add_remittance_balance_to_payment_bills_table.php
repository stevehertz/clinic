<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_bills', function (Blueprint $table) {
            //
            $table->decimal('remittance_balance', 10, 2)->default(0)->after('remittance_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_bills', function (Blueprint $table) {
            //
            $table->dropColumn('remittance_balance');
        });
    }
};
