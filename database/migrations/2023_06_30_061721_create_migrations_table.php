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
        Schema::create('payment_handling', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id', 6);
            $table->string('encryption_key', 20);
            $table->string('sub_merchant_id', 2);
            $table->string('reference_no');
            $table->string('paymode', 2);
            $table->string('return_url');
            $table->string('eazy_pay_base_url');
            $table->string('transaction_id');
            $table->string('transaction_amount');
            $table->timestamp('transaction_date')->nullable();
            $table->string('mobileno', 10);
            $table->string('name');
            $table->string('email');
            $table->string('amount');
            $table->string('user_id');
            $table->string('order_id');
            $table->string('payment_status');
            $table->string('payment_status_code');
            $table->text('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_handling');
    }
};
