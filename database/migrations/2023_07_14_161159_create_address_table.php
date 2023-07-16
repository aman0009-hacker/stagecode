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
        Schema::create('address', function (Blueprint $table) {
            //$table->id();
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('order_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_district')->nullable();
            $table->string('shipping_city')->nullable();
            $table->integer('shipping_zipcode')->nullable();
            $table->string('shipping_gst_number')->nullable();
            $table->integer('shipping_gst_statecode')->nullable();
            $table->tinyInteger('is_same')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_district')->nullable();
            $table->string('billing_city')->nullable();
            $table->integer('billing_zipcode')->nullable();
            $table->string('billing_gst_number')->nullable();
            $table->string('billing_gst_statecode')->nullable();
            $table->timestamps();
            //$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
