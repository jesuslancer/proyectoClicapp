<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPlanHabilidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_habilidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('plan_unidad_id');
            $table->unsignedInteger('habilidad_unidad_id');
            $table->string('tipo',9);
            $table->string('estatus',15);
            $table->unsignedInteger('unidad_id');
            $table->unsignedInteger('profesor_asignatura_id');
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
        Schema::dropIfExists('plan_habilidades');
    }
}
