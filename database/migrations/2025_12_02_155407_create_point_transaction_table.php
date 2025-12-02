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
        Schema::create('point_transaction', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');
            $table->foreignId('laundry_order_id')->nullable()->constrained('laundry_orders')->onDelete('set null');

            $table->integer('amount');
            $table->enum('type', ['earn', 'redeem']);
            $table->text('description')->nullable();
            $table->integer('balance_after_transaction');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_transaction');
    }
};
