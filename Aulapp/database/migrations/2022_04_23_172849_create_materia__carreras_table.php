<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia__carreras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_carrera');
            $table->foreign('id_carrera')->references('id')->on('carreras');

            $table->unsignedBigInteger('id_materia');
            $table->foreign('id_materia')->references('id')->on('materias');

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
        Schema::dropIfExists('materia__carreras');
    }
}
