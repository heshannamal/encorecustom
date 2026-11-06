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
        Schema::create('daily_balances', function (Blueprint $table) {

            $table->id();

            $table->date('date')->unique();

            $table->decimal('opening_balance', 15, 2)->default(0);

            $table->decimal('cash_sales', 15, 2)->default(0);

            $table->decimal('expected_balance', 15, 2)->default(0);

            $table->decimal('closing_balance', 15, 2)->nullable();

            $table->boolean('is_open')->default(false);

            $table->boolean('is_closed')->default(false);

            $table->timestamp('opened_at')->nullable();

            $table->timestamp('closed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_balances');
    }
};
