<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBienesPorAlbergueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes_por_albergue', function (Blueprint $table) {
            $table->bigIncrements('id_bienesxalbergue');
            $table->unsignedBigInteger('id_bienpatrimonial');
            $table->unsignedBigInteger('id_albergue');
            $table->unsignedBigInteger('cantidad_total');
            $table->unsignedBigInteger('cantidad_disponible');
            $table->timestamps();

            $table->foreign('id_bienpatrimonial')->references('id_bienpatrimonial')->on('bienes_patrimoniales')->onDelete('cascade');
            $table->foreign('id_albergue')->references('id')->on('albergue')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bienes_por_albergue');
    }
}
