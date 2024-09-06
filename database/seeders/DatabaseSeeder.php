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
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 200; $i++) {
            \DB::table('blogs')->insert([
                'title' => $faker->sentence($nbWords = 6, 
                        $variableNbWords = true),
                'description' => $faker->paragraph
                        ($nbSentences = 2,
                        $variableNbSentences = true),
                'content' => $faker->text($maxNbChars = 500),
            ]);
        }
    }
}
