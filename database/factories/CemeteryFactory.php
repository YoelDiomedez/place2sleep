<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cemetery;
use Faker\Generator as Faker;

$factory->define(Cemetery::class, function (Faker $faker) {
    return [
        'appellation' => $faker->company
    ];
});
