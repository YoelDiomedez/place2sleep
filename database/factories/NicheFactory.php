<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Niche;
use Faker\Generator as Faker;

$factory->define(Niche::class, function (Faker $faker) {
    
    $pavilions = \App\Pavilion::select('id')
                            ->where('type', 'N')
                            ->whereIn('cemetery_id', [1, 2])
                            ->get();
    return [
        'pavilion_id' => $faker->unique()->randomElement($pavilions),
        'row_x'       => strtoupper($faker->randomLetter),
        'col_y'       => $faker->numberBetween($min = 1, $max = 99),
        'category'    => $faker->randomElement(['A', 'P', 'O', 'D', 'Z']),
        'state'       => $faker->randomElement(['D', 'T', 'O', 'R', 'Z']),
        'price'       => $faker->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 99999)
    ];
});
