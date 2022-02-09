<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('level')->insert([
            'level' => 'superadmin',
        ]);
        DB::table('level')->insert([
            'level' => 'admin',
        ]);
        DB::table('level')->insert([
            'level' => 'admin',
        ]);
        DB::table('level')->insert([
            'level' => 'guru',
        ]);
        DB::table('level')->insert([
            'level' => 'siswa',
        ]);
    }
}