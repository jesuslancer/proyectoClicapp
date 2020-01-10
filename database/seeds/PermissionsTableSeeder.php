<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-admin',
            'permission-admin',
            'user-admin',
            'professor-admin',
          ];
        foreach ($permissions as $permission) {
            DB::table('permissions')->insert(['name' => $permission,'guard_name'=>'web']);
        }
    }
}
