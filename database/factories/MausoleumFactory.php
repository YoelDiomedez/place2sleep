<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mausoleum;
use Faker\Generator as Faker;

$factory->define(Mausoleum::class, function (Faker $faker) {

    $pavilions = \App\Pavilion::select('id')
                            ->where('type', 'M')
                            ->whereIn('cemetery_id', [1, 2])
                            ->get();

    $number = $faker->numberBetween($min = 1, $max = 10);

    return [
        'pavilion_id'   => $faker->unique()->randomElement($pavilions),
        'name'          => $faker->company.' '.$faker->companySuffix,
        'location'      => $faker->bothify('Mz. ? Lote ##'),
        'doc'           => $faker->numerify('Resolucion N° ###-'.date('Y').'-SBPP-P'),
        'size'          => $number,
        'availability'  => $number,
        'extensions'    => 0,
        'price'         => $faker->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 99999)
    ];
});
