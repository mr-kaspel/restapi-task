<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class moviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            \DB::table('movies')->insert([
                'name' => $faker->sentence,
                'id_genres' => rand(1, 50)
            ]);
        }
    }
}
