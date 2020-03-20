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
        $this->call([CategorySeeder::class]);
//        $this->call([RolesSeeder::class]);
//        $this->call([UsersTableSeeder::class]);
//        factory(\App\Restaurant::class, 5)->create();
//        factory(\App\MenuItem::class, 5)->create();
    }
}
