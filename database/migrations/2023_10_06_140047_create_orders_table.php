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
            $table->string('status');
            $table->decimal('total',10,2);
            $table->string('menu_name');
            $table->text('order_notes');
            $table->string('name');
            $table->text('address');
            $table->string('contact');
            $table->date('dates');
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
