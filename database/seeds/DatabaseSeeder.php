<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TalkinfosTableSeeder::class);
        $this->call(GroupinfosTableSeeder::class);
        $this->call(UserinfosTableSeeder::class);
    }
}
