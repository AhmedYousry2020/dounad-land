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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string("warehouse_name_".SL, 100);
            $table->string("warehouse_name_".FL, 100);
            $table->text('address');
            $table->string('phone_number');
            $table->time('word_from');
            $table->time('word_end');
            $table->time('delivery_from');
            $table->time('delivery_to');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
