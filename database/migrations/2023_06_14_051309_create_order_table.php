<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            //$table->increments('id');
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->float('amount')->nullable();
            $table->date('transaction_date')->nullable();
            $table->integer('transaction_id')->nullable();
            $table->string('status')->default('New')->nullable();
            $table->string('person')->nullable();
            $table->string('user_id')->nullable();
            $table->string('firm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
