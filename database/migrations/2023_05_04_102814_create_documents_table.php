<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gstcard')->nullable();;
            $table->string('msmecard')->nullable();;
            $table->string('itrcard')->nullable();;
            $table->string('aadharcard')->nullable();;
            $table->string('pancard')->nullable();;
            $table->string('utilitycard')->nullable();;
            $table->string('gstcardpath')->nullable();
            $table->string('msmecardpath')->nullable();
            $table->string('itrcardpath')->nullable();
            $table->string('aadharcardpath')->nullable();
            $table->string('pancardpath')->nullable();
            $table->string('utilitycardpath')->nullable();
            // $table->string('docpath');
            $table->unsignedBigInteger('userid');
            $table->timestamps();
            // $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
