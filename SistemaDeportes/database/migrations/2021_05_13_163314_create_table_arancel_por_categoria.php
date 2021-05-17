<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateTableArancelPorCategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arancel_por_categoria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_tipo_de_arancel');
            $table->enum('estado', ['VIGENTE','NO VIGENTE'])->default('VIGENTE');
            $table->date('fecha_de_registro')->default(Carbon::now());
            $table->decimal('importe', 8, 2);
            $table->string('nro_resolucion');

            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('id_tipo_de_arancel')->references('id')->on('tipo_de_arancel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arancel_por_categoria');
    }
}
