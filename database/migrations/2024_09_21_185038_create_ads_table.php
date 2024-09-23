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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->integer('price');
            $table->integer('rooms');
            $table->string('address');
            $table->enum('gender', ['male', 'female']);
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('status_id');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->foreign('branch_id')->on('branches')->references('id')->cascadeOnDelete();
            $table->foreign('status_id')->on('statuses')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
