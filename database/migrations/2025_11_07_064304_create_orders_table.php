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
            $table->integer('user_id');
            $table->integer('inventory_type_id');
            $table->decimal('total_amount', 10, 2);
            $table->integer('items_count');
            $table->tinyInteger('payment_status')->comment('0: Not Paid, 1: Paid, 2: Partially Paid, 3: Refunded');
            $table->integer('payment_method_id');
            $table->tinyInteger('fulfillment_status')->comment('0: Unfulfilled, 1: Fulfilled');
            $table->integer('shipping_method_id');
            $table->string('shipping_address')->nullable();
            $table->string('shipping_street')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_postal_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
