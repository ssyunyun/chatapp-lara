<?php

use Illuminate\Database\Seeder;

class TalkinfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i <= 10 ; $i++) {

            \App\Talkinfo::create([
                'comment' => $i .'番目のテキスト',
                'userid' => 1,
                'username' => 'user1',
                'groupid' => 1,
            ]);
        }
    
    }
}
