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
        Schema::create('ship_type', function (Blueprint $table) {
            $table->foreignId('shipid')->constrained('ships')->onDelete('cascade');
            $table->foreignId('typeid')->constrained('types')->onDelete('cascade');
            $table->primary(['shipid', 'typeid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_type');
    }
};
