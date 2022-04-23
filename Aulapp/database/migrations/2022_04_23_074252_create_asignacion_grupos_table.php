<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user_rol');
            $table->foreign('id_user_rol')->references('id')->on('user_rols');
        
            $table->unsignedBigInteger('id_grupo')->unique();
            $table->foreign('id_grupo')->references('id')->on('grupos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('asignacion_grupos');
    }
}
