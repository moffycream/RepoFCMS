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
        Schema::create('menu_food', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menuID');
            $table->unsignedBigInteger('foodID');
            $table->timestamps();

            $table->foreign('menuID')->references('menuID')->on('menus')->onDelete('cascade');
            $table->foreign('foodID')->references('foodID')->on('foods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_food');
    }
};
