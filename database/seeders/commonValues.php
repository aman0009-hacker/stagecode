<?php

namespace Database\Seeders;

use App\Models\adminCommonValueChange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class commonValues extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       adminCommonValueChange::create([
        "yard_record_value"=>270
       ]) ;
    }
}
