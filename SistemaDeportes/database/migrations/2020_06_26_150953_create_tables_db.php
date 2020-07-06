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
        Schema::create('estados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estado');
        });

        Schema::create('facultad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
        });

        Schema::create('tipo_de_socio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');
        });

        Schema::create('socios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_apellido');
            $table->string('dni')->unique();
            $table->date('fecha_de_nacimiento');
            $table->string('domicilio');
            $table->string('lu_legajo')->nullable();
            $table->string('telefono_celular');
            $table->string('telefono_de_emergencia');
            $table->string('email')->nullable();
            $table->enum('estado_documentacion', ['COMPLETA','INCOMPLETA','VENCIDA'])->default('INCOMPLETA');
            $table->enum('certificado_de_alumno', ['SI','NO'])->default('NO')->nullable();
            $table->unsignedBigInteger('id_facultad')->nullable();
            $table->string('lugar_de_trabajo')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('id_tipo_socio');
            $table->unsignedBigInteger('id_estado');

            $table->foreign('id_tipo_socio')->references('id')->on('tipo_de_socio')->onDelete('cascade');
            $table->foreign('id_facultad')->references('id')->on('facultad')->onDelete('cascade');
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
        Schema::dropIfExists('socios');
        Schema::dropIfExists('facultad');
        Schema::dropIfExists('tipo_de_socio');
        Schema::dropIfExists('estados');
    }
}
