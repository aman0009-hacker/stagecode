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
        Schema::table('yards', function (Blueprint $table) {
            //
            $table->integer('supervisorid')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yards', function (Blueprint $table) {
            //
            $table->integer('supervisorid')->nullable(false)->change();
        });
    }
};
