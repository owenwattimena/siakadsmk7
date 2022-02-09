<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Owen Wattimena',
            'username' => 'wentoxwtt',
            'email' => 'wentoxwtt@gmail.com',
            'password' => Hash::make('password'),
            'level_id' => 1
        ]);
    }
}