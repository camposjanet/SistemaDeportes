<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesDb extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineas_telefonica', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('linea');
        });

        Schema::create('estados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estado');
        });

        Schema::create('unidades_academicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unidad');
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('categoria');
        });

        Schema::create('estados_de_documento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades_academicas');
        Schema::dropIfExists('lineas_telefonica');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('estados');
        Schema::dropIfExists('estados_de_documento');
    }
}
