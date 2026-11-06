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
        Schema::create('order_payment_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('order_billing_detail_id');
            $table->integer('card_type_id')->comment('1=Visa, 2=Master');
            $table->string('card_holder_name');
            $table->text('card_number');
            $table->string('card_last_four_digit');
            $table->string('card_expiry_month');
            $table->string('card_expiry_year');
            $table->text('card_csv');
            $table->decimal('sub_total', 10, 2);
            $table->decimal('invoice_total', 10, 2);
            $table->decimal('processing_fee', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payment_details');
    }
};
