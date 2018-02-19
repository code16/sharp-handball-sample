<?php

use Faker\Generator as Faker;

$factory->define(App\Player::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'team_id' => function() {
            return factory(\App\Team::class)->create()->id;
        },
        'ratings' => $faker->numberBetween(1,5)
    ];
});
