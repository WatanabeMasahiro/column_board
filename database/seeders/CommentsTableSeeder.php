<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'article_id' => 3,
            'comment' => 'これはテストです。',
            'updated_at' => new DateTime(),
            'created_at' => new DateTime(),
        ];
        DB::table('comments')->insert($param);

        $param = [
            'article_id' => 3,
            'comment' => 'これはテストです。
ここで改行を入れてみま<br />した。',
            'updated_at' => new DateTime(),
            'created_at' => new DateTime(),
        ];
        DB::table('comments')->insert($param);

    }
}
