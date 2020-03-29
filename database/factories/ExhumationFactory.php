<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Exhumation;
use Faker\Generator as Faker;

$factory->define(Exhumation::class, function (Faker $faker) {
    return [
        'deceased_id'   => $faker->numberBetween($min = 1, $max = 50),
        'reference_doc' => $faker->numerify('Resolucion N° ###-'.date('Y').'-SBPP-P'),
        'notes'         => $faker->text($maxNbChars = 500),
    ];
});
