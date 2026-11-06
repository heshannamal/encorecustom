<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packing_slip_items', function (Blueprint $table) {
            $table->id();
            $table->integer('packing_slip_id');
            $table->integer('order_id')->nullable();
            $table->integer('order_item_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('sub_product_id')->nullable();
            $table->string('product_image_url')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('quantity');
            $table->longText('base64_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_slip_items');
    }
};
