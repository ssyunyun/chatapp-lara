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

            $password = 'user'.$i;
            $hashedPassword = hash('sha256',$password);

            \App\Userinfo::create([
                'username' => 'user'.$i,
                'password' => $hashedPassword,
                'groupid' => $i,
                'groupname' => 'test'.$i,
            ]);
        }
    }
}
