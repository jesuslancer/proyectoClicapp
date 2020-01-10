<?php

use Illuminate\Database\Seeder;

class EstablecimientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('establecimientos')->insert([
            'nombre' => 'Establecimiento 1',
            'rbd' => 1,
            'dv'=>1,
            'nivel_id'=>1,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
    }
}
