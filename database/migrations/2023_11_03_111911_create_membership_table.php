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
        Schema::create('membership', function (Blueprint $table) {
            $table->id('membershipID');
            $table->unsignedBigInteger('userID');
            $table->integer('tier_level');
            $table->decimal('total_payments', 10, 2); // precison 10 and 2 decimal point
            $table->integer('discount_amount')->default(0); // default discount is 0
            $table->integer('remaining_discounts')->default(5); // only 5 discount 
            $table->timestamps();
            $table->foreign('userID')->references('userID')->on('user_accounts')->onDelete('cascade');

        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership');
    }
};
