<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => 'Ahmed',
            'type' => 'admin',
            'email' => 'admin@app.com',
            'bio'  => 'hello in my dashboard',
            'photo' => 'man.png',
            'password' => bcrypt('123456'),
        ]);
    }
}
