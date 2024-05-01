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
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->integer('num_of_items');
            $table->string("box_name_".FL, 100);
            $table->string("box_name_".SL, 100);
            $table->longText("description_".FL)->nullable();
            $table->longText("description_".SL)->nullable();
            $table->string('box_image');
            $table->double('price', 6, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boxes');
    }
};
