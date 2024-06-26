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
        DB::table('users')->insert([
            'name'  => 'Jhon Smith',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('123456'),      
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
