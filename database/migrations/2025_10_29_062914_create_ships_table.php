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
        Schema::create('ships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price_per_day');
            $table->integer('capacity');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('length')->nullable();
            $table->integer('year_built')->nullable();
            $table->integer('max_speed')->nullable();
            $table->string('amenities')->nullable();
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ships');
    }
};
