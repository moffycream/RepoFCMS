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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('orderID');
            $table->unsignedBigInteger('userID');
            $table->char('status');
            $table->decimal('total',10,2);
            $table->char('menu_name');
            $table->char('order_notes');
            $table->char('name');
            $table->char('address');
            $table->char('contact');
            $table->timestamps();
            $table->foreign('userID')->references('userID')->on('user_accounts')->onDelete('cascade');
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
