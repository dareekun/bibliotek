<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class users extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
