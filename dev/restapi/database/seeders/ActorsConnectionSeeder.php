<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActorsConnectionSeeder extends Seeder
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
            \DB::table('actorsconnection')->insert([
                'id_movie' => rand(1, 50),
                'id_actors' => rand(1, 50)
            ]);
        }
    }
}
