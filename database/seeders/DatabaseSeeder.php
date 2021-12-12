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
            'department' => 'Engineering',
            'password' => bcrypt('developer123'),
            'role' => 'developer',
        ]);
    }
}
