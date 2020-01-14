<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaProfesorAsignatura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesor_asignaturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('profesor_id');
            $table->unsignedInteger('asignatura_id');
            $table->unsignedInteger('establecimiento_id');
            $table->unsignedInteger('nivel_id');
            $table->unsignedInteger('curso_id');
            $table->unsignedInteger('periodo_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesor_asignaturas');
    }
}
