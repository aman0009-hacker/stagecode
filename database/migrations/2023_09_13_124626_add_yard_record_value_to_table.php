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
        Schema::table('admin_common_value_changes', function (Blueprint $table) {
            $table->string('yard_record_value')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_common_value_changes', function (Blueprint $table) {
            $table->dropColumn(array_merge(["yard_record_value"]));
        });
    }
};
