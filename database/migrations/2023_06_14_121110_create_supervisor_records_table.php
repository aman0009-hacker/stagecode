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
        Schema::create('supervisor_records', function (Blueprint $table) {
            //$table->id();
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->integer('supervisor_id')->nullable();
            $table->string('product')->nullable();
            $table->string('quantity')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisor_records');
    }
};
