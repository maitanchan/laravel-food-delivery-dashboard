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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('title');
            $table->string('desc');
            $table->string('totalStars');
            $table->string('starNumber');
            $table->string('cat');
            $table->string('price');
            $table->string('cover');
            $table->string('shortTitle');
            $table->string('shortDesc');
            $table->string('deliveryTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};