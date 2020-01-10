<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaRegiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regiones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',10);
            $table->string('subtitulo',10);
            $table->string('descripcion');
            $table->integer('num_horas');
            $table->integer('num_clases');
            $table->unsignedInteger('asignatura_id');
            $table->unsignedInteger('nivel_id');
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
        Schema::dropIfExists('regiones');
    }
}
