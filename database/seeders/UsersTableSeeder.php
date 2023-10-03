<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // Create a sample user
        DB::table('users')->insert([
            'name' => 'Muhammad Zikri',
            'email' => 'muhammadzikri@example.com',
            'password' => Hash::make('password'), 
        ]);
    }
}
