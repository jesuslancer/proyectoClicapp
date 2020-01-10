<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $roles = ['Administrador','UTP','Profesor','Alumno', 'Sostenedor'];
        // foreach ($roles as $role) {
        //     DB::table('roles')->insert(['name' => $role,'guard_name'=>'web']);
        // }
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->save(); 
    }
}
