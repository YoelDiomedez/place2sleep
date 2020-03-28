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
        factory(App\Price::class, 200)->create();
        $this->call(UserTableSeeder::class);
        factory(App\Pavilion::class, 200)->create();
        factory(App\Niche::class, 100)->create();
        factory(App\Mausoleum::class, 100)->create();
    }
}
