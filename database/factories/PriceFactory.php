<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Price;
use Faker\Generator as Faker;

$factory->define(Price::class, function (Faker $faker) {
    return [
        'period_id'   => 1,
        'cemetery_id' => $faker->numberBetween($min = 1, $max = 2),
        'concept'     => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'amount'      => $faker->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 999999)

    ];
});
