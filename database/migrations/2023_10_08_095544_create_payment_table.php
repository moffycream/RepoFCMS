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
        Schema::create('payment_info', function (Blueprint $table) {
            $table->id('transactionID'); // Primary Key
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('orderID');
            $table->decimal('total_price', 10, 2);   
            $table->string('payment_method');
            $table->string('bank');//online banking 
            $table->string('bank_username');
            $table->string('account_number'); 
            $table->string('password');
            $table->string('amount_paid');
            $table->string('description');
            $table->string('card_number');//credit/debit card
            $table->string('cvv');
            $table->string('cardholder_name');
            $table->text('billing_address');
            $table->string('ewallet_type');//ewallet
            $table->string('ewallet_username');
            $table->timestamp('dateOfPayment')->default(now());
            $table->timestamp('dateOfPurchase')->default(now());
            $table->timestamps();
            
            // Define foreign key constraints
            $table->foreign('orderID')->references('orderID')->on('orders')->onDelete('cascade');
            $table->foreign('userID')->references('userID')->on('user_accounts')->onDelete('cascade');
            
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_info');
    }
};
