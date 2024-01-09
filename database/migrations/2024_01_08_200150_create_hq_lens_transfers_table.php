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
        Schema::create('hq_lens_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('to_workshop_id');
            $table->unsignedBigInteger('lens_id');
            $table->date('transfered_date');
            $table->integer('quantity');
            $table->string('condition');
            $table->boolean('status')->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('to_workshop_id')->references('id')->on('workshops')->onDelete('cascade');
            $table->foreign('lens_id')->references('id')->on('hq_lenses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hq_lens_transfers');
    }
};
