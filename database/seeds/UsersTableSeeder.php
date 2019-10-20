<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'photo' => "https://semantic-ui.com/images/avatar/large/steve.jpg",
            'description' => 'Soy el CEO bitch',
        ]);
        User::create([
            'name' => 'Elyse',
            'email' => 'elyse@example.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'photo' => "https://semantic-ui.com/images/avatar2/large/elyse.png",
            'description' => 'Desarrollador',
        ]);

        User::create([
            'name' => 'Matt Giampietro',
            'email' => 'matt@example.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'photo' => "https://semantic-ui.com/images/avatar2/large/matthew.png",
            'description' => 'Analista',
        ]);
        
        
    }
}
