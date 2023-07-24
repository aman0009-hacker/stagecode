<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
      public function up(): void
    {
        Schema::table('address', function (Blueprint $table) {
            $table->text('psiec_address_ludhiana')->nullable();
        });

           // Set default value for existing rows
           DB::table('address')->update([
            'psiec_address_ludhiana' => json_encode([
                "psiec_biilling_name" => "Punjab Small Industries & Export Corp. Ind.",
                "psiec_billing_area" => "Area-B",
                "psiec_biilling_city" => "Ludhiana",
                "psiec_biilling_gst" => "03AABCP1602M1ZT",
                "psiec_biilling_state" => "Punjab",
                "psiec_biilling_code" => "03",
                "psiec_biilling_cin" => "U51219CH9162SGC002427",
            ]),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('address', function (Blueprint $table) {
            $table->dropColumn('psiec_address_ludhiana');
        });
    }
};
