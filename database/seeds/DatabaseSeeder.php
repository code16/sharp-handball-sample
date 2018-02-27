<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected static $teamNames = [
        'Spain' => [
            'FC Barcelone',
            'BM Ciudad Real',
            'PSA Pampelune',
            'CB Cantabria',
            'Elgorriaga Bidassoa',
        ],
        'Germany' => [
            'VfL Gummersbach',
            'THW Kiel',
            'SC Magdebourg',
            'ASKV Francfort/Oder',
            'HSV Hambourg',
            'Frisch Auf Göppingen',
            'TV Großwallstadt',
            'SG Flensburg-Handewitt',
            'SC DHfK Leipzig',
        ],
        'Russia' => [
            'CSIA Moscou',
            'Medvedi Tchekhov'
        ],
        'Bielorussia' => [
            'SKA Minsk',
        ],
        'Croatia' => [
            'Partizan Bjelovar',
            'RK Zagreb',
        ],
        'France' => [
            'Montpellier Handball',
        ],
        'Czech Republic' => [
            'Dukla Prague',
        ],
        'Romania' => [
            'Steaua Bucarest',
            'Dinamo Bucarest',
        ],
        'Serbia' => [
            'Metaloplastika Šabac',
        ],
        'Hungary' => [
            'Budapest Honvéd',
        ],
        'Sweden' => [
            'Redbergslid Göteborg',
        ],
        'Poland' => [
            'KS Kielce'
        ],
        'Macedonia' => [
            'RK Vardar Skopje'
        ]
    ];

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

        $teams = [];

        foreach(static::$teamNames as $country => $teamNames) {
            foreach($teamNames as $teamName) {
                $teams[] = \App\Team::create([
                    "name" => $teamName,
                    "country" => $country
                ]);
            }
        }

        foreach($teams as $team) {
            factory(\App\Player::class, rand(10,20))->create([
                "team_id" => $team->id
            ]);
        }
    }
}
