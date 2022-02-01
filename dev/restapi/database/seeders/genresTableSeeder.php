<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class genresTableSeeder extends Seeder
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
            \DB::table('genres')->insert([
                'name' => $faker->jobTitle,
            ]);
        }
    }
}
