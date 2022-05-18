<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompromisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compromisos', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();//Variable para la relacin con la tabla user
            $table->bigInteger('accion_id')->unsigned();//Variable para la relacin con la tabla acciones
            $table->text('action_plan');
            $table->boolean('state')->nullable();
            $table->string('detail')->nullable();//
            $table->string('archive')->nullable();
            $table->text('comment')->nullable();
            $table->string("date_implementation")->nullable();
            $table->string("date_delivery")->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');//Atributo de la relacion del atributo id de user con use_id de Post
            $table->foreign('accion_id')->references('id')->on('accions')->onDelete("cascade");//Atributo de la relacion del atributo id de user con use_id de Post
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compromisos');
    }
}
