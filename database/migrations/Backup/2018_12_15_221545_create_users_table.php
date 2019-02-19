<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('puid');
            $table->string('url_pool');
            $table->string('pool');
            $table->smallInteger('status')->default(1);
            $table->smallInteger('first_login')->default(0);
            $table->integer('rol_id')->unsigned()->index();
            $table->integer('departamento_id')->unsigned()->index();
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
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
        Schema::dropIfExists('users');
    }
}
