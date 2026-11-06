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
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->integer('inventory_type_id');
            $table->integer('product_id');
            $table->integer('sub_product_id');
            $table->integer('size_id');
            $table->integer('color_master_id')->nullable();
            $table->integer('quantity');
            $table->decimal('unit_price',10,2);
            $table->text('reason')->nullable();
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustments');
    }
};
