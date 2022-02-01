<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class actorsTableSeeder extends Seeder
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
            \DB::table('actors')->insert([
                'name' => $faker->name,
            ]);
        }
    }
}
