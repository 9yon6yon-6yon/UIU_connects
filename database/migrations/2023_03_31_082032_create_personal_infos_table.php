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
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id('personal_info_id')->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->string('userName', 50);
            $table->string('fathersName', 50);
            $table->string('mothersName', 50);
            $table->string('image_path', 255);
            $table->date('dob');
            $table->string('nationality', 100);
            $table->enum('status', ['married', 'single', 'divorced'])->default('single');
            $table->text('address');
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
        Schema::dropIfExists('personal_infos');
    }
};
