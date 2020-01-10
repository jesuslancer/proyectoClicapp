<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPersonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut',100)->nullable();
            $table->string('nombres',100);
            $table->string('apellido_paterno',100);
            $table->string('apellido_materno',100)->nullable();
            $table->string('direccion')->nullable();
            $table->string('email',100);
            $table->string('telefono_contacto_1',50);
            $table->string('telefono_contacto_2',50)->nullable();
            $table->date('fecha_nac');
            $table->string('genero',1);
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('persona');
    }
}
