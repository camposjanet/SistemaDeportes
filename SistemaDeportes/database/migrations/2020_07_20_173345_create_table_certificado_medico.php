<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCertificadoMedico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado_medico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_de_emision')->nullable();
            $table->date('fecha_de_vencimiento')->nullable();
            $table->string('nombre_medico')->nullable();
            $table->unsignedBigInteger('id_ficha');
            $table->unsignedBigInteger('id_estado_documento');

            $table->foreign('id_ficha')->references('id')->on('fichas')->onDelete('cascade');
            $table->foreign('id_estado_documento')->references('id')->on('estados_de_documento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificado_medico');
    }
}
