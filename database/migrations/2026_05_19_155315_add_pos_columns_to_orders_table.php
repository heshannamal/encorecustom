<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // PAYMENT
            $table->string('payment_method')->nullable()->after('shipping_phone');

            // CASH PAYMENT
            $table->decimal('customer_cash', 10, 2)->default(0)->after('payment_method');

            $table->decimal('balance', 10, 2)->default(0)->after('customer_cash');

            // DISCOUNT
            $table->string('discount_type')->nullable()->after('balance');

            $table->double('discount_value')->default(0)->after('discount_type');

            $table->decimal('discount_amount', 10, 2)->default(0)->after('discount_value');


            // CARD
            $table->string('card_type')->nullable()->after('discount_amount');

            $table->string('card_last_four')->nullable()->after('card_type');

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'payment_method',
                'customer_cash',
                'balance',
                'discount_type',
                'discount_value',
                'discount_amount',
                'card_type',
                'card_last_four'
            ]);

        });
    }
};
