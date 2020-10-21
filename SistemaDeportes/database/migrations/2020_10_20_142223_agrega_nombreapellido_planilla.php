<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregaNombreapellidoPlanilla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planilla_asistencias', function (Blueprint $table) {
        $table->string("nombre_apellido");
        $table->date("fecha_vto");
        $table->string('dni')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planilla_asistencias', function (Blueprint $table) {
        $table->dropColumn("nombre_apellido");
        $table->dropColumn("fecha_vto");
        $table->dropColumn("dni");
        });
    }
}
