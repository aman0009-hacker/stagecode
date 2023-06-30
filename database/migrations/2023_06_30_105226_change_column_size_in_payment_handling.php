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
        Schema::table('payment_handling', function (Blueprint $table) {
            $table->string('merchant_id')->change();
            $table->string('encryption_key')->change();
            $table->string('sub_merchant_id')->change();
            $table->string('paymode')->change();
            $table->string('mobileno')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_handling', function (Blueprint $table) {
            //
        });
    }
};
