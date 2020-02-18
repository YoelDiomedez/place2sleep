<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Deceased::class, 100)->create();
        factory(App\Relative::class, 100)->create();
        $this->call(PeriodsTableSeeder::class);
        $this->call(CemeteriesTableSeeder::class);
    }
}
