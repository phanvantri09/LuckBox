<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class addTransaction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     // 4 => "Doanh thu bán box", 5 => 'Hoa hồng bán box'
            DB::table('transactions')->insert([
                'id_user' => 86,
                'id_admin_accept' => 86,
                'type' => 4,
                'status' => 2,
                'id_cart' => 1541,
                'total' => 2000000,
                'created_at' =>'2023-09-21 20:31:35',
                'updated_at' =>'2023-09-21 20:31:35',
            ]);
            DB::table('transactions')->insert([
               'id_user' => 86,
               'id_admin_accept' => 86,
               'type' => 5,
               'status' => 2,
               'id_cart' => 1541,
               'total' => 38160,
               'created_at' =>'2023-09-21 20:31:35',
               'updated_at' =>'2023-09-21 20:31:35',
           ]);
    }
}
