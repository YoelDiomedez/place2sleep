<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mausoleum;
use Faker\Generator as Faker;

$factory->define(Mausoleum::class, function (Faker $faker) {

    $pavilions = \App\Pavilion::select('id')
                            ->where('type', 'M')
                            ->whereIn('cemetery_id', [1, 2])
                            ->get();
    return [
        'pavilion_id'   => $faker->unique()->randomElement($pavilions),
        'name'          => $faker->company.' '.$faker->companySuffix,
        'location'      => $faker->bothify('Mz. ? Lote ##'),
        'reference_doc' => $faker->numerify('Resolucion N° ###-'.date('Y').'-SBPP-P'),
        'size'          => $faker->numberBetween($min = 1, $max = 99),
        'availability'  => $faker->numberBetween($min = 1, $max = 99),
        'extensions'    => $faker->numberBetween($min = 1, $max = 99),
        'price'         => $faker->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 99999)
    ];
});
