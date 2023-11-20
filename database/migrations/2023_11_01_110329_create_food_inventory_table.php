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
        Schema::create('food_inventory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('foodID');
            $table->unsignedBigInteger('inventoryID');
            $table->unsignedBigInteger('amount');
            $table->timestamps();
            $table->foreign('foodID')->references('foodID')->on('foods')->onDelete('cascade');
            $table->foreign('inventoryID')->references('inventoryID')->on('inventory')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_inventory');
    }
};
