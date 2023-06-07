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
        Schema::create('yards', function (Blueprint $table) {
            //$table->id();
            // $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string("yardcountry")->nullable();
            $table->string("yardstate")->nullable();
            $table->string("yardcity")->nullable();
            $table->string("yardplace")->nullable();
            $table->integer("supervisorid")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yards');
    }
};
