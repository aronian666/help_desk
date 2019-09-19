<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name'=> 'Impresora',
            'type_id'=> 1
        ]);
        DB::table('products')->insert([
            'name'=> 'Computador',
            'type_id'=> 1
        ]);
        DB::table('products')->insert([
            'name'=> 'Internet',
            'type_id'=> 1
        ]);
        DB::table('products')->insert([
            'name'=> 'Word',
            'type_id'=> 2
        ]);
        DB::table('products')->insert([
            'name'=> 'Excel',
            'type_id'=> 2
        ]);
        DB::table('products')->insert([
            'name'=> 'Windows',
            'type_id'=> 2
        ]);
    }
}
