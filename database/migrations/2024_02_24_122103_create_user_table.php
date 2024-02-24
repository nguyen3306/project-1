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
        Schema::create('users', function (Blueprint $table) {
                $table->id();
            $table->string('name');
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
            $table->integer('phone');
            $table->string('address');
            $table->string('password');
            $table->char('email');
            $table->string('ma_GT');
            $table->bigInteger('SL_ma_duoc_GT');
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
