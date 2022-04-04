<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('estrategia_id')->unsigned();//Variable para la relacin con la tabla user

            $table->string('name', 500);
            //$table->text('description');
            $table->boolean('state')->nullable();
            $table->timestamps();

            $table->foreign('estrategia_id')->references('id')->on('estrategias')->onDelete("cascade");//Atributo de la relacion del atributo id de user con use_id de Accions
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accions');
    }
}
