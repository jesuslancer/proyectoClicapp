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
        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            RoleUserSeeder::class,
        //     PermissionsTableSeeder::class,
        //     RolesHasPermissionsTableSeeder::class,
        //     ModelHasRolesTableSeeder::class,
        //    // RolesAndPermissionsSeeder::class,
        //     AsignaturasTableSeeder::class,
        //     EstablecimientosTableSeeder::class,
        ]);
    }
}
