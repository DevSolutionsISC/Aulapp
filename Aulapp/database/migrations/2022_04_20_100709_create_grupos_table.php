<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('id_materia');
            //$table->unsignedBigInteger('id_carrera');
            //$table->unsignedBigInteger('id_docente');

            $table->foreign('id_materia')
            ->references('id')->on('materias');

           // $table->foreign('id_carrera')
             //     ->references('id')->on('carreras');

            //$table->foreign('id_docente')
              //    ->references('id')->on('docentes');

          
      
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
        Schema::dropIfExists('grupos');
    }
}
