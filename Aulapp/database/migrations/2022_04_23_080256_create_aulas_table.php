<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            
            $table->unsignedBigInteger('id_section');
            $table->foreign('id_section')->references('id')
	        ->on('sections');

          /*  $table->foreignId('id_section')
	        ->nullable()
	        ->constrained('sections')
	        ->cascadeOnUpdate()
	        ->nullOnDelete();*/
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
        Schema::dropIfExists('aulas');
    }
}
