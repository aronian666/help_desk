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
            'role_id' => 1
        ]);
    }
}
