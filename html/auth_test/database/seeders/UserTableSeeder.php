<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追記

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //userのダミーデータを3つ作成
        DB::table('users')->insert([
            [
                'name' => 'test',
                'email' => 'test@test',
                'password' => bcrypt('test123'),
            ],
            [
                'name' => 'test1',
                'email' => 'test1@test',
                'password' => bcrypt('test123'),
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test',
                'password' => bcrypt('test123'),
            ],
        ]);
    }
}
