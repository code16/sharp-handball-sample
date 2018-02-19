<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            "email" => "admin@example.org",
            "password" => bcrypt("secret"),
            "name" => "Bob Admin"
        ]);

        $teams = factory(\App\Team::class, 20)->create();

        foreach($teams as $team) {
            factory(\App\Player::class, 10)->create([
                "team_id" => $team->id
            ]);
        }
    }
}
