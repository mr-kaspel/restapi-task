<?php

namespace Database\Seeders;

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
        $this->call(moviesTableSeeder::class);
        $this->call(genresTableSeeder::class);
        $this->call(actorsTableSeeder::class);
        $this->call(ActorsConnectionSeeder::class);

    }
}
