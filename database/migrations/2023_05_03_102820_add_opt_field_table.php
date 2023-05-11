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
        Schema::table('users', function (Blueprint $table) {
            $table->text('otp')
                    ->after('password')
                    ->nullable();

            $table->timestamp('otp_generated_at')
                    ->after('two_factor_secret')
                    ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'otp',
                'otp_generated_at',
            ]));
        });
    }
};
