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
        Schema::create('box_items', function (Blueprint $table) {
            $table->foreignId('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreignId('box_id')->references('id')->on('boxes')->onDelete('cascade');
            $table->integer('min_num');
            $table->integer('max_num');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_items');
    }
};
