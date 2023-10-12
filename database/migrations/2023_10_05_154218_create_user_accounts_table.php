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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id('userID');
            $table->string('username');
            $table->string('password');
            $table->char('phone');
            $table->char('firstName');
            $table->char('lastName');
            $table->char('email');
            $table->char('streetAddress');
            $table->char('city');
            $table->char('postcode');
            $table->char('accountType');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};
