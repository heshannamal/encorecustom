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
        Schema::create('master_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('sub_product_id');
            $table->integer('size_id');
            $table->integer('color_master_id');
            $table->integer('inventory_type_id');
            $table->integer('stock_qty');
            $table->decimal('unit_price', 10, 2);
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
