<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('servicio_id');
            $table->integer('user_id');
            $table->integer('presupuesto_id')->nullable();
            $table->string('nombre');
            $table->text('descripcion');
            $table->date('inicio');
            $table->date('final');
            $table->string('frecuencia');
            $table->float('horas');
            $table->integer('codigo');
            $table->integer('finalizado')->nullable();
            $table->integer('estatus')->default(0);
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
        Schema::dropIfExists('tareas');
    }
}
