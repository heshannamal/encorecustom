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
        Schema::create('pos_draft_items', function (Blueprint $table) {
            $table->id();
            $table->integer('draft_id');
            $table->integer('sub_product_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_draft_items');
    }
};
