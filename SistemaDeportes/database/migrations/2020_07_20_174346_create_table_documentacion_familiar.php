<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocumentacionFamiliar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentacion_familiar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_de_presentacion');
            $table->string('nombre_documentacion')->nullable();
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
        Schema::dropIfExists('documentacion_familiar');
    }
}
