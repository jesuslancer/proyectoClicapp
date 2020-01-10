<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPlanActitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_actitudes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('plan_unidad_id');
            $table->unsignedInteger('actitud_unidad_id');
            $table->string('tipo',9);
            $table->string('estatus',15);
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
        Schema::dropIfExists('plan_actitudes');
    }
}
