<?php

use Faker\Generator as Faker;

$teamNames = [
    'FC Barcelone',
    'VfL Gummersbach',
    'THW Kiel',
    'BM Ciudad Real',
    'Dukla Prague',
    'SC Magdebourg',
    'SKA Minsk',
    'RK Zagreb',
    'Steaua Bucarest',
    'Frisch Auf Göppingen',
    'Metaloplastika Šabac',
    'TV Großwallstadt',
    'Partizan Bjelovar',
    'Medvedi Tchekhov',
    'PSA Pampelune',
    'SG Flensburg-Handewitt',
    'Dinamo Bucarest',
    'CSIA Moscou',
    'Budapest Honvéd',
    'CB Cantabria',
    'Elgorriaga Bidassoa',
    'Redbergslid Göteborg',
    'SC DHfK Leipzig',
    'ASKV Francfort/Oder',
    'RK Borac Banja Luka',
    'Montpellier Handball',
    'RK Celje',
    'HSV Hambourg',
    'KS Kielce',
    'RK Vardar Skopje'
];

$factory->define(App\Team::class, function (Faker $faker) use($teamNames) {
    return [
        'name' => $faker->unique()->randomElement($teamNames)
    ];
});
