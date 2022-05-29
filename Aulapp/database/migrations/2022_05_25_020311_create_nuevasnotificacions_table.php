<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNuevasnotificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nuevasnotificacions', function (Blueprint $table) {
            $table->id();
            $table->integer("cantidad_not");
            $table->timestamps();
            $table->unsignedBigInteger('user_rol_id');
            $table->foreign('user_rol_id')->references('id')->on('user_rols')->constrained()->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nuevasnotificacions');
    }
}
