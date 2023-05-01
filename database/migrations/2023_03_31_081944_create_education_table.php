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
        Schema::create('education', function (Blueprint $table) {
            $table->id('edu_id')->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->string('institution', 255);
            $table->string('degree', 255);
            $table->string('field_of_study', 255);
            $table->date('graduation_date');
            $table->text('education_description');
            $table->timestamps();
            $table->foreign('user_id')->references('u_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
