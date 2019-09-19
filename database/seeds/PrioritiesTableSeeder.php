<?php

use Illuminate\Database\Seeder;

class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->insert([
            'name'=> 'Bajo'
        ]);
        DB::table('priorities')->insert([
            'name'=> 'Medio'
        ]);
        DB::table('priorities')->insert([
            'name'=> 'Alto'
        ]);
        DB::table('priorities')->insert([
            'name'=> 'Urgente'
        ]);
    }
}
