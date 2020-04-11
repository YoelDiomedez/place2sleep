<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'home']);

        Permission::create(['name' => 'deceased']);
        Permission::create(['name' => 'relative']);
        Permission::create(['name' => 'cemetery']);

        Permission::create(['name' => 'niche']);
        Permission::create(['name' => 'mausoleum']);
        Permission::create(['name' => 'pavilion']);

        Permission::create(['name' => 'inhumation']);
        Permission::create(['name' => 'exhumation']); 
    }
}
