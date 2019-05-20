<?php

use Illuminate\Database\Seeder;

class UserinfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i <= 4 ; $i++) {

            \App\Userinfo::create([
                'name' => 'user'.$i,
                'password' => 'user'.$i,
                'groups_id' => $i,
                'groups' => 'test'.$i,
            ]);
        }
    }
}
