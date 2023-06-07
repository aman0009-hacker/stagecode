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
        Schema::create('users', function (Blueprint $table) {
            //$table->id();
            //$table->bigIncrements('id');
            $table->uuid('id')->primary()->default(Str::uuid());
            //$table->uuid('id')->primary()->default(DB::raw('UUID()'));
            // $table->uuid('id')->primary();
            $table->string('name');
            $table->string('last_name');
            //$table->string('email')->unique();
            $table->string('email')->unique();
            $table->string('contact_number');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
          
         
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
