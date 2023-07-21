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
        Schema::table('orders', function (Blueprint $table) {
            $table->text('psiec_address')->nullable();
            $table->text('delivery_terms')->nullable();
            $table->float('final_amount')->nullable();
            $table->float('cgst')->nullable();
            $table->float('sgst')->nullable();
            $table->float('taxable_value')->nullable();
            $table->float('tax_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['psiec_address', 'delivery_terms', 'amount', 'cgst', 'sgst', 'taxable_value', 'tax_amount']);
        });
    }
};
