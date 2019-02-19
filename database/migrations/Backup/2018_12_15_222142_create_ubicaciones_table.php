<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rack_id')->unsigned()->index();
            $table->integer('posicion');
            $table->integer('instalador_user_id')->unsigned()->index();
            $table->string('minero_id')->unique();
            $table->string('minero_nombre');
            $table->string('serial_equipo');
            $table->string('serial_fuente');
            $table->string('modelo');
            $table->smallInteger('status')->default(1);
            $table->foreign('rack_id')->references('id')->on('racks');
            $table->foreign('instalador_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('ubicaciones');
    }
}
