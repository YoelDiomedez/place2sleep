<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Deceased;
use Faker\Generator as Faker;

$factory->define(Deceased::class, function (Faker $faker) {
    return [
        'names' =>    $faker->name,
        'surnames' => $faker->lastName,
        'gender' =>   $faker->randomElement(['M', 'F']),
        'marital_status' => $faker->randomElement(['S', 'C', 'V', 'D']),
        'document_type' =>  $faker->randomElement(['DNI', 'RUC', 'P. NAC.', 'CARNET EXT.', 'PASAPORTE', 'OTRO']),
        'document_numb' =>  $faker->unique()->randomNumber(8),
        'birth_date' => $faker->date,
        'death_date' => $faker->date,
        'country_origin' => $faker->country
    ];
});
