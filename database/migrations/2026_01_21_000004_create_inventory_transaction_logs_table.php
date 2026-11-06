<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_type_id')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->string('reference_type')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('sub_product_id')->nullable();
            $table->integer('inventory_type_id')->nullable();
            $table->integer('color_master_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('qty_before')->default(0);
            $table->integer('qty_after')->default(0);
            $table->integer('qty_change')->default(0);
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->integer('performed_by')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            // $table->index(['transaction_type_id']);
            // $table->index(['sub_product_id']);
            // $table->index(['inventory_type_id']);
            // $table->index(['color_master_id']);
            // $table->index(['size_id']);
            // $table->index(['reference_id', 'reference_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_transaction_logs');
    }
};


