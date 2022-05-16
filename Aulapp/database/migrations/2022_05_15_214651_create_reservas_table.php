<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string("motivo");
            $table->string("estado");
            $table->date("fecha_examen");
            $table->time("hora_inicio");
            $table->time("hora_fin");
            $table->integer("cantE");
            $table->string("grupos");
            $table->string("docentes");
            $table->string("materia");
            $table->string("motivo_rechazo");
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
        Schema::dropIfExists('reservas');
    }
}
