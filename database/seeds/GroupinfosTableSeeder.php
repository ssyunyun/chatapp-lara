<?php

use Illuminate\Database\Seeder;

class GroupinfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i <= 4 ; $i++) {

            \App\Groupinfo::create([
                'groupname' => 'test'.$i,
                'comment' => 'test用です',
                'userid' => $i,
            ]);
        }

    }
}
