<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => '773a15b0-1984-11ee-994a-4d29924623d7',
                'name' => 'ANGLES',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            1 => 
            array (
                'id' => '77409fe0-1984-11ee-9633-b76374009a2b',
                'name' => 'BLOOM CASTER BLOO',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            2 => 
            array (
                'id' => '77495490-1984-11ee-9e56-6d6cf6481c75',
                'name' => 'CHANNEL',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            3 => 
            array (
                'id' => '774d08a0-1984-11ee-88e7-379d826750e5',
                'name' => 'CHEQUERED PLATES',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            4 => 
            array (
                'id' => '775102d0-1984-11ee-b398-7d1ab91fe445',
                'name' => 'CR COILS',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            5 => 
            array (
                'id' => '7762c780-1984-11ee-815a-3742321d3dd9',
                'name' => 'HR COILS',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            6 => 
            array (
                'id' => '776dae10-1984-11ee-adce-e9a2151c3a9e',
                'name' => 'HSM PLATES',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            7 => 
            array (
                'id' => '77719570-1984-11ee-933c-ad3a6b8eb77b',
                'name' => 'HR SHEETS',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            8 => 
            array (
                'id' => '777505f0-1984-11ee-b4c6-c523c95273db',
                'name' => 'JOISTS',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            9 => 
            array (
                'id' => '777716d0-1984-11ee-b618-bbc3612fcf41',
                'name' => 'MS FLATS',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            10 => 
            array (
                'id' => '7779d910-1984-11ee-b0a5-691323fe7b82',
                'name' => 'NPB',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            11 => 
            array (
                'id' => '777c7c60-1984-11ee-8afe-65ecec28cd38',
                'name' => 'PLATE MILL PLATES',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            12 => 
            array (
                'id' => '779137b0-1984-11ee-9a23-a91b17a2e8a8',
                'name' => 'SSCR COIL',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            13 => 
            array (
                'id' => '77933cd0-1984-11ee-9f7c-47feda01b036',
                'name' => 'SSHR COIL',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            14 => 
            array (
                'id' => '77955360-1984-11ee-8a12-877cf0408a75',
                'name' => 'STEEL SCRAP',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            15 => 
            array (
                'id' => '77972460-1984-11ee-8813-cf5547b0a5cd',
                'name' => 'TMT BARS',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            16 => 
            array (
                'id' => '779c6770-1984-11ee-aae4-f35f17181736',
                'name' => 'WIRE RODS',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:02:02',
                'updated_at' => '2023-07-03 15:02:02',
            ),
            17 => 
            array (
                'id' => 'b09214a0-10c8-11ee-ac64-f5700fd05d22',
                'name' => 'Pipe',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-06-22 06:47:43',
                'updated_at' => '2023-06-22 06:47:43',
            ),
            18 => 
            array (
                'id' => 'bb5cb950-1984-11ee-bb4d-1722c7b7314e',
                'name' => 'a1111',
                'category_id' => '179f3280-2392-11ee-bb96-27e8f9efbde1',
                'created_at' => '2023-07-03 15:03:56',
                'updated_at' => '2023-07-03 15:03:56',
            ),
        ));
        
        
    }
}