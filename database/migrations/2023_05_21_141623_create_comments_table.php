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
        Schema::create('comments', function (Blueprint $table) {
            //$table->increments('id');
            // $table->uuid('id')->primary()->default(DB::raw('UUID()'));
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->integer('approved')->default(0);
            $table->timestamp('approved_at')->nullable();
            $table->text('comment')->nullable();
         
            //$table->unsignedBigInteger('user_id');
            $table->uuid('user_id');
            $table->timestamps();
            $table->integer("admin_id");

            // Define foreign key constraint for user_id column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
