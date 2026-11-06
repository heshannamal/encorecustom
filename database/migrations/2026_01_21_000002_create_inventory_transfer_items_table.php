<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_transfer_items', function (Blueprint $table) {
            $table->id();
            $table->integer('inventory_transfer_id');
            $table->integer('sub_product_id');
            $table->integer('color_master_id')->nullable();
            $table->integer('size_id');
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->integer('from_stock_qty')->default(0);
            $table->integer('transfer_qty')->default(0);
            $table->timestamps();

            // $table->index(['inventory_transfer_id']);
            // $table->index(['sub_product_id']);
            // $table->index(['color_master_id']);
            // $table->index(['size_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_transfer_items');
    }
};


