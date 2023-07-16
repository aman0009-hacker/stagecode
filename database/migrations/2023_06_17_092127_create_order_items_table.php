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
        Schema::create('order_items', function (Blueprint $table) {
            //$table->increments('id');
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('category_name')->nullable();
            $table->string('description')->nullable();
            $table->string('diameter')->nullable();
            $table->string('size')->nullable();
            $table->string('quantity')->nullable();
            $table->string('measurement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
