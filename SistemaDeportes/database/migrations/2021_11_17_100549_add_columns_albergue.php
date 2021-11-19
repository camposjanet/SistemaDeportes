<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsAlbergue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('albergue', function (Blueprint $table) {
            $table->unsignedBigInteger('cupo_total');
            $table->unsignedBigInteger('cupo_disponible');
            $table->string('estado_albergue')->default('HABILITADO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('albergue', function (Blueprint $table) {
            Schema::dropIfExists('albergue');
        });
    }
}
