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
        Schema::create('categories', function (Blueprint $table) {
            // $table->id();
            // $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('name');     //pipe , 
            // $table->unsignedBigInteger('category_id');
            $table->uuid('category_id');
            $table->foreign('category_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
