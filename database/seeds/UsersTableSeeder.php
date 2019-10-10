<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = [
            ['name' => 'Peter', 'created_at' => '2019-09-10 00:00:00'],
            ['name' => 'Tom', 'created_at' => '2019-09-10 00:00:00'],
            ['name' => 'Frans', 'created_at' => '2019-09-10 00:00:00'],
            ['name' => 'Bas', 'created_at' => '2019-09-10 00:00:00'],
        ];

        DB::table('spelers')->insert($players);

        $user = ['name' => 'Tom', 'email' => 'tom.jongbloets@grizzlymarketing.nl', 'password' => Hash::make('Welkom1')];

        DB::table('users')->insert($user);
    }
}
