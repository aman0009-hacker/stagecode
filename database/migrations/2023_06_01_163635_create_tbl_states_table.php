<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 30);
            $table->integer('country_id')->default(1);
        });

        $query="INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
        (1, 'Andaman and Nicobar Islands', 101),
        (2, 'Andhra Pradesh', 101),
        (3, 'Arunachal Pradesh', 101),
        (4, 'Assam', 101),
        (5, 'Bihar', 101),
        (6, 'Chandigarh', 101),
        (7, 'Chhattisgarh', 101),
        (8, 'Dadra and Nagar Haveli', 101),
        (9, 'Daman and Diu', 101),
        (10, 'Delhi-NCR', 101),
        (11, 'Goa', 101),
        (12, 'Gujarat', 101),
        (13, 'Haryana', 101),
        (14, 'Himachal Pradesh', 101),
        (15, 'Jammu and Kashmir', 101),
        (16, 'Jharkhand', 101),
        (17, 'Karnataka', 101),
        (18, 'Kenmore', 101),
        (19, 'Kerala', 101),
        (20, 'Lakshadweep', 101),
        (21, 'Madhya Pradesh', 101),
        (22, 'Maharashtra', 101),
        (23, 'Manipur', 101),
        (24, 'Meghalaya', 101),
        (25, 'Mizoram', 101),
        (26, 'Nagaland', 101),
        (27, 'Narora', 101),
        (28, 'Natwar', 101),
        (29, 'Odisha', 101),
        (30, 'Paschim Medinipur', 101),
        (31, 'Pondicherry', 101),
        (32, 'Punjab', 101),
        (33, 'Rajasthan', 101),
        (34, 'Sikkim', 101),
        (35, 'Tamil Nadu', 101),
        (36, 'Telangana', 101),
        (37, 'Tripura', 101),
        (38, 'TEST', 101),
        (39, 'UP-1', 101),
        (40, 'xxxxxx', 101),
        (41, 'West Bengal', 101),
        (42, 'UP-2', 101)";
        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
