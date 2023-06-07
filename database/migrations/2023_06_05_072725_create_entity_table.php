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
        Schema::create('entities', function (Blueprint $table) {
            // $table->id();
            // $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->uuid('id')->primary()->default(Str::uuid());
            // $table->string('name');     //ewr pipe , 
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('size')->nullable();
            $table->string('diameter')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('remaining')->nullable();
            $table->string('measurement')->nullable();
            // $table->unsignedBigInteger('entity_id');
            $table->uuid('entity_id');
            // $table->timestamps();
            $table->foreign('entity_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity');
    }
};
