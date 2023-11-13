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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('reviewID');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('menuID')->nullable();
            $table->string('reviewTitle');
            $table->string('reviewContent');
            $table->integer('reviewRating');
            $table->string('reviewCategory');
            $table->timestamps();

            $table->foreign('userID')->references('userID')->on('user_accounts');
            $table->foreign('menuID')->references('menuID')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
