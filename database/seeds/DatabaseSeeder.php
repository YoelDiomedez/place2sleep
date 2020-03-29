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

        factory(App\Cemetery::class, 2)->create();
        factory(App\Pavilion::class, 200)->create();

        $this->call(NicheTableSeeder::class);
        $this->call(MausoleumTableSeeder::class);

        $this->call(UserTableSeeder::class);
    }
}
