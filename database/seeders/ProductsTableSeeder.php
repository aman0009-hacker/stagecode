<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'name' => 'Steel',
                'created_at' => '2023-06-22 06:38:59',
                'updated_at' => '2023-06-22 06:38:59',
            ),
            1 => 
            array (
                'id' => 'e2268c80-10c7-11ee-8722-c9aa42136e46',
                'name' => 'Coal',
                'created_at' => '2023-06-22 06:41:57',
                'updated_at' => '2023-06-22 06:41:57',
            ),
        ));
        
        
    }
}