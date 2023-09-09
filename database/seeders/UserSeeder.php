<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            // DB::table('users')->insert([
            //     'type' => 111,
            //     'email' => Str::random(10) . '@gmail.com',
            //     'password' => Hash::make('12345678'),
            //     'status' => 1
            // ]);
            DB::table('users')->insert([
                'type' => 222,
                'email' => 'admin'.$i.'@gmail.com',
                'password' => Hash::make('12345678@'),
                'status' => 1
            ]);
        }
    }
}
