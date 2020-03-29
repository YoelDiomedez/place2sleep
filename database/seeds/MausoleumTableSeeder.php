<?php

use App\Mausoleum;
use Illuminate\Database\Seeder;

class MausoleumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pavilions = \App\Pavilion::select('id')
                                    ->where('type', 'M')
                                    ->whereIn('cemetery_id', [1, 2])
                                    ->count();

        factory(Mausoleum::class, $pavilions)->create();
    }
}
