<?php

use Illuminate\Database\Seeder;
use App\RoleUser;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$role = new RoleUser();
        $role->role_id = '1';
        $role->user_id = '1';
        $role->save(); 

        $role = new RoleUser();
        $role->role_id = '2';
        $role->user_id = '2';
        $role->save();

        $role = new RoleUser();
        $role->role_id = '3';
        $role->user_id = '3';
        $role->save();

        $role = new RoleUser();
        $role->role_id = '4';
        $role->user_id = '4';
        $role->save();

        $role = new RoleUser();
        $role->role_id = '5';
        $role->user_id = '5';
        $role->save(); 
    }
}
