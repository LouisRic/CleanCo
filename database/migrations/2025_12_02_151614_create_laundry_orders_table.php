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
        Schema::create('laundry_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');
            $table->foreignId('laundry_type_id')->constrained('laundry_types')->onDelete('restrict');
            $table->foreignId('voucher_id')->nullable()->constrained('vouchers')->onDelete('set null');

            $table->date('order_date');
            $table->date('pickup_date')->nullable();

            $table->float('weight_kg');
            $table->integer('price_per_kg');
            $table->integer('total_price');

            $table->text('notes')->nullable();

            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->enum('laundry_status', ['process', 'washed', 'ready', 'completed'])->default('process');
            $table->enum('pickup_status', ['pending', 'picked_up'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_orders');
    }
};
