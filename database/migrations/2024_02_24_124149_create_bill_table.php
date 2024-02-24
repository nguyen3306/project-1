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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('car')->onDelete('cascade');
            $table->datetimes('start_date');
            $table->datetimes('end_date');
            $table->integer('extra_hours');
            $table->bigInteger('total');
            $table->foreign('voucher_id')->references('id')->on('voucher')->onDelete('cascade');
            $table->bigInteger('voucher_value');
            $table->foreign('order_id')->references('id')->on('oders')->onDelete('cascade');
            $table->bigInteger('code');
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
