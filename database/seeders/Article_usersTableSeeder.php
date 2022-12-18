<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class Article_usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $param = [
        //     'article_id' => 15,
        //     'user_id' => 1,
        //     'updated_at' => new DateTime(),
        //     'created_at' => new DateTime(),
        // ];
        // DB::table('article_users')->insert($param);

        // $param = [
        //     'article_id' => 15,
        //     'user_id' => 2,
        //     'updated_at' => new DateTime(),
        //     'created_at' => new DateTime(),
        // ];
        // DB::table('article_users')->insert($param);

        // $param = [
        //     'article_id' => 15,
        //     'user_id' => 3,
        //     'updated_at' => new DateTime(),
        //     'created_at' => new DateTime(),
        // ];
        // DB::table('article_users')->insert($param);

        // $param = [
        //     'article_id' => 13,
        //     'user_id' => 1,
        //     'updated_at' => new DateTime(),
        //     'created_at' => new DateTime(),
        // ];
        // DB::table('article_users')->insert($param);

        // $param = [
        //     'article_id' => 12,
        //     'user_id' => 2,
        //     'updated_at' => new DateTime(),
        //     'created_at' => new DateTime(),
        // ];
        // DB::table('article_users')->insert($param);

        $param = [
            'article_id' => 12,
            'user_id' => 3,
            'updated_at' => new DateTime(),
            'created_at' => new DateTime(),
        ];
        DB::table('article_users')->insert($param);

    }
}
