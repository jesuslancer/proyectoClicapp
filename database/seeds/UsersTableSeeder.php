<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = ['Administrador','UTP','Profesor','Alumno', 'Sostenedor'];
        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user,
                'email' => strtolower($user).'@gmail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]);
        }
    }
}
