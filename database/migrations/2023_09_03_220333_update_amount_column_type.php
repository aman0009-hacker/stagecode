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
            // Change the data type of the 'amount' column to DOUBLE
            $table->decimal('amount', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Revert the column type change if needed
        //  Schema::table('orders', function (Blueprint $table) {
        //     $table->decimal('amount', 10, 2)->change();
        // });
    }
};
