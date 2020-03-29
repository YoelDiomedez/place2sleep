<?php

use App\Niche;
use Illuminate\Database\Seeder;

class NicheTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pavilions = \App\Pavilion::select('id')
                                    ->where('type', 'N')
                                    ->whereIn('cemetery_id', [1, 2])
                                    ->count();

        factory(Niche::class, $pavilions)->create();
    }
}
