<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstrategiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estrategias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('problematica_id')->unsigned();
            $table->string('number');
            $table->string('name');
            $table->boolean('state')->nullable();
            $table->timestamps();

            $table->foreign('problematica_id')->references('id')->on('problematicas')->onDelete("cascade");//Atributo de la relacion del atributo id de user con use_id de Problematicas
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estrategias');
    }
}
