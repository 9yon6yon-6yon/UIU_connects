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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id('j_application')->autoIncrement();
            $table->unsignedBigInteger('applied_user');
            $table->unsignedBigInteger('j_id');
            $table->string('file_path');
            $table->timestamps();
            $table->foreign('applied_user')->references('u_id')->on('users')->onDelete('cascade');
            $table->foreign('j_id')->references('job_id')->on('jobs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
