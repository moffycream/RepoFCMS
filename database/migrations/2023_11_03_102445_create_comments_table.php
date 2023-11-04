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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('commentID');
            $table->unsignedBigInteger('reviewID'); 
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('replyToCommentID')->nullable(); 
            $table->string('commentContent');
            $table->timestamps();

            $table->foreign('reviewID')->references('reviewID')->on('reviews')->onDelete('cascade');
            $table->foreign('userID')->references('userID')->on('user_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
