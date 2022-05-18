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
            $table->unsignedBigInteger('user_rol_id');
            $table->unsignedBigInteger('grupo_id');
            
            $table->foreign('user_rol_id')

            ->references('id')->on('user_rols')->constrained()->onDelete('cascade');

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