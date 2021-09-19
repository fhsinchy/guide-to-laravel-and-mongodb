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
        $users = \App\Models\User::factory(5)->create();

        $users->each(function($user) {
            \App\Models\Post::factory(5)->create(['user_id' => $user->id]);
        });
    }
}
