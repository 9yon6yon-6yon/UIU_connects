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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id('contact_id')->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->string('email', 50);
            $table->string('phone', 25);
            $table->string('others');
            $table->timestamps();
            $table->foreign('user_id')->references('u_id')->on('users')->onDelete('cascade');
            $table->unique(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
