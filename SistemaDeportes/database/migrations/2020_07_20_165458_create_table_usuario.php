<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni')->unique();
            $table->date('fecha_de_nacimiento');
            $table->string('domicilio');
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('id_estado');

            $table->foreign('id_estado')->references('id')->on('estados')->onDelete('cascade');
        });

        Schema::create('telefonos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_linea_telefonica');
            $table->unsignedBigInteger('id_tipo_telefono');
            $table->unsignedBigInteger('id_usuario');

            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_tipo_telefono')->references('id')->on('tipos_de_telefono')->onDelete('cascade');
            $table->foreign('id_linea_telefonica')->references('id')->on('lineas_telefonica')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefonos');
        Schema::dropIfExists('usuarios');
    }
}
