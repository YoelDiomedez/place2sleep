<?php

use App\Cemetery;
use Illuminate\Database\Seeder;

class CemeteryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cemetery::create(['appellation' => 'Yanamayo']);
        Cemetery::create(['appellation' => 'Laykakota']);
    }
}
