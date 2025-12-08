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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('type', ['percentage', 'fixed']); // diskonnya pake persen atau nominal
            $table->integer('value'); // 10% atau 10.000
            $table->integer('minimum_spend')->default(0); // min hrs spend brp buat pake voucher
            $table->integer('points_required'); // point yg dibutuhin utk redeem voucher
            $table->date('valid_from');
            $table->date('valid_until');
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
