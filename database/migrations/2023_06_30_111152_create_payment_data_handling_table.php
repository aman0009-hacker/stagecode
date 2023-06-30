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
        Schema::create('payment_data_handling', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id')->nullable();
            $table->string('encryption_key')->nullable();
            $table->string('sub_merchant_id')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('paymode')->nullable();
            $table->string('return_url')->nullable();
            $table->string('eazy_pay_base_url')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_amount')->nullable();
            $table->timestamp('transaction_date')->nullable();
            $table->string('mobileno')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('amount')->nullable();
            $table->string('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_status_code')->nullable();
            $table->text('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_data_handling');
    }
};
