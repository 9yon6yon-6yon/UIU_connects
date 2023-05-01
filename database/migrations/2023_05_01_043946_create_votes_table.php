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
        Schema::create('votes', function (Blueprint $table) {
            $table->id('votes_id')->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pst_id');
            $table->enum('type', ['upvote', 'downvote']);
            $table->timestamps();
        
            $table->foreign('user_id')->references('u_id')->on('users')->onDelete('cascade');
            $table->foreign('pst_id')->references('post_id')->on('posts')->onDelete('cascade');
            $table->unique(['user_id', 'pst_id']);

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
