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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string("item_name_".FL, 100);
            $table->string("item_name_".SL, 100);
            $table->string("item_slug", 150);
            $table->longText("description_".FL)->nullable();
            $table->longText("description_".SL)->nullable();
            $table->string('item_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
