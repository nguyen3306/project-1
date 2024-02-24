<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('car_id');
            $table->integer('status')->default('1');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('extra_hours');
            $table->bigInteger('total');
            $table->unsignedBigInteger('voucher_id');
            $table->bigInteger('voucher_value');
            $table->integer('payment_status')->default('0');
            $table->bigInteger('amount');
            $table->bigInteger('code');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('voucher_id')->references('id')->on('voucher')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');

        });



        Schema::table('orders', function (Blueprint $table) {


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
