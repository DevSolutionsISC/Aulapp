<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_docentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_rol_id')->nullable();
            $table->unsignedBigInteger('grupo_id');

            $table->foreign('grupo_id')

            ->references('id')->on('grupos')->constrained()->onDelete('cascade');


            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('asignacion_docentes');
    }
}