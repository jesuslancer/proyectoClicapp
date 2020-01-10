<?php

use Illuminate\Database\Seeder;

class ModelHasRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 6; $i++){
            DB::table('model_has_roles')->insert([
                'role_id' => $i,
                'model_type' => 'App\Models\User',
                'model_id' => $i,
            ]);
        }
    }
}
