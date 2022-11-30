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
        Schema::create('frame_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('from_clinic_id');
            $table->unsignedBigInteger('to_clinic_id');
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('transfer_user_id'); // Doctor who has transfered 
            $table->string('frame_code');
            $table->date('transfer_date');
            $table->string('transfer_status');
            $table->string('transfer_stock_status');
            $table->text('transfer_remarks')->nullable();
            $table->unsignedBigInteger('received_user_id')->nullable(); // Doctor who has received
            $table->string('received_date')->nullable(); // Date Received
            $table->string('received_status')->nullable();
            $table->string('received_stock_status')->nullable();
            $table->text('received_remarks')->nullable();
            $table->timestamps();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('from_clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('to_clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('frame_stocks')->onDelete('cascade');
            $table->foreign('transfer_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('received_user_id')->nullable()->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frame_transfers');
    }
};
