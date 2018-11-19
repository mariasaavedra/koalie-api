<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Maria Saavedra',
            'email' => 'maria@gmail.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'David Andrews',
            'email' => 'david@gmail.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Logan Fritts',
            'email' => 'logan@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
