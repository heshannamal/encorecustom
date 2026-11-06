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
        Schema::table('order_payment_details', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->after('paid_amount');
            $table->string('transaction_account_number')->nullable()->after('transaction_id');
            $table->string('transaction_account_type')->nullable()->after('transaction_account_number');
            $table->integer('transaction_response_code')->nullable()->after('transaction_account_type')->comment('1 = Success, any other = Failed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_payment_details', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
            $table->dropColumn('transaction_account_number');
            $table->dropColumn('transaction_account_type');
            $table->dropColumn('transaction_response_code');
        });
    }
};
