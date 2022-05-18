<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblematica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problematicas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('eje_id')->unsigned();
            $table->string('number');
            $table->string('name');
            $table->boolean('state')->nullable();
            $table->timestamps();

            $table->foreign('eje_id')->references('id')->on('ejes')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problematicas');
    }
}
