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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('user_address');
            $table->double('sub_total', 6, 2);
            $table->double('total_amount', 6, 2);
            $table->double('tax', 6, 2);
            $table->enum('order_status',['pending','confirmed','canceled','delivered'])->default('pending');
            $table->enum('shipment_status',['pending','confirmed','canceled','delivered'])->default('pending');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->integer('items_count');
            $table->string('payment_method');
            $table->string('shipment_method');
            $table->foreignId('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
