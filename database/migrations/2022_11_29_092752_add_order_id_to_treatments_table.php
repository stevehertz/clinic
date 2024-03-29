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
        Schema::table('treatments', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('order_id')->nullable()->after('workshop_id');
            $table->foreign('order_id')->nullable()->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatments', function (Blueprint $table) {
            //
            $table->dropForeign('treatments_order_id_foreign');
            $table->dropColumn('order_id');
        });
    }
};
