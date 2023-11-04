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
            $table->unsignedBigInteger('orderID'); // Foreign Key for the orders table
            $table->unsignedBigInteger('userID'); // Foreign Key for the user_accounts table
            $table->decimal('totalPrice', 10, 2);   
            $table->string('paymentMethod');
            $table->string('Username'); // Online banking
            $table->string('Receipient_Account_Number'); // Online banking
            $table->string('card_number');
            $table->string('cvv');
            $table->string('cardholder_name');
            $table->text('billing_address');
            $table->string('type_of_Ewallet');
            $table->string('recipient_name'); // E-wallet 
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
