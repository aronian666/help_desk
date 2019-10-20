<?php

use Illuminate\Database\Seeder;
use App\Status;
class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'Abierto',
            'description' => 'El ticket fue creado'
        ]);
        Status::create([
            'name' => 'Asignado',
            'description' => 'El ticket fue asignado',
            'icon' => 'address card'
        ]);
        Status::create([
            'name' => 'En progreso',
            'description' => 'El ticket se esta resolviendo',
            'icon' => 'stethoscope'
        ]);
        Status::create([
            'name' => 'En espera',
            'description' => 'El ticket tiene que aclarase'
        ]);
        Status::create([
            'name' => 'Cerrado',
            'description' => 'El ticket esta cerrado'
        ]);
        Status::create([
            'name' => 'Resuelto',
            'description' => 'El ticket se resolvio',
            'icon' => 'archive'
        ]);
    }
}
