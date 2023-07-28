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
        Schema::table('supervisor_records', function (Blueprint $table) {
            $table->date('created_at')->nullable()->change();
            $table->date('updated_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supervisor_records', function (Blueprint $table) {
            $table->date('created_at')->change();
            $table->date('updated_at')->change();
        });
    }
};
