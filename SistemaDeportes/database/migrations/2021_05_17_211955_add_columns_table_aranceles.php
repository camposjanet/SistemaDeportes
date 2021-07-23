<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class AddColumnsTableAranceles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aranceles', function (Blueprint $table) {
            $table->string('nro_recibo');
            $table->date('fecha_de_inicio')->default(Carbon::now());
            $table->integer('cantidad_meses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aranceles', function (Blueprint $table) {
            $table->dropColumn('nro_recibo');
            $table->dropColumn('fecha_de_inicio');
            $table->dropColumn('cantidad_meses');
        });
    }
}
