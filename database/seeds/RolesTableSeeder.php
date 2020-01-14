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


        $role = new Role();
        $role->name = 'UTP';
        $role->description = 'Jefe de la Unidad Técnico Pedagógica';
        $role->save();

        $role = new Role();
        $role->name = 'profesor';
        $role->description = 'Profesor';
        $role->save();

        $role = new Role();
        $role->name = 'estudiante';
        $role->description = 'Estudiante';
        $role->save();
        
        $role = new Role();
        $role->name = 'sostenedor';
        $role->description = 'Sostenedor';
        $role->save();
    }
}
