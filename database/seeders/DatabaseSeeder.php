<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'developer',
            'email' => 'mada.baskoro@id.panasonic.com',
            'nik' => 'developer',
            'department' => '1',
            'password' => bcrypt('developer123'),
            'role' => 'developer',
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'nik' => 'admin',
            'department' => '1',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
    }
}