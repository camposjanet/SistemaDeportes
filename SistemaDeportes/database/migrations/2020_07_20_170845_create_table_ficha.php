<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateTableFicha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lu_legajo')->nullable();
            $table->enum('estado_documentacion', ['COMPLETA','INCOMPLETA','VENCIDA'])->default('INCOMPLETA');
            $table->unsignedBigInteger('id_unidad_academica')->nullable();
            $table->string('lugar_de_trabajo')->nullable();
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_estado');
            $table->date('fecha')->default(Carbon::now());

            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('id_unidad_academica')->references('id')->on('unidades_academicas')->onDelete('cascade');
            $table->foreign('id_estado')->references('id')->on('estados')->onDelete('cascade');
           
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichas');
    }
}
