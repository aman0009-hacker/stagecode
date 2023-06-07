<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            //$table->id();
            // $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('filename')->nullable();
            $table->string('path')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('file_type')->nullable();
            $table->string('fileno')->nullable();
            //$table->unsignedBigInteger('user_id');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
