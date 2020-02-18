<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Relative;
use Faker\Generator as Faker;

$factory->define(Relative::class, function (Faker $faker) {
    return [
        'names' =>    $faker->name,
        'surnames' => $faker->lastName,
        'document_type' =>  $faker->randomElement(['DNI', 'RUC', 'P. NAC.', 'CARNET EXT.', 'PASAPORTE', 'OTRO']),
        'document_numb' =>  $faker->unique()->randomNumber(8),
        'cellphone_numb' => $faker->unique()->randomNumber(9),
        'address' =>  $faker->address
    ];
});
