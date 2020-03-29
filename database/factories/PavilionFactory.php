<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pavilion;
use Faker\Generator as Faker;

$factory->define(Pavilion::class, function (Faker $faker) {
    return [
        'cemetery_id' => $faker->randomElement([1, 2]),
        'type'        => $faker->randomElement(['N', 'M']),
        'name'        => $faker->bothify('Pabellón ##')
    ];
});
