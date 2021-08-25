<?php

use Illuminate\Database\Seeder;

class EstadosReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados_reserva')->insert([
            ["nombre_estado" => 'PENDIENTE'],
            ["nombre_estado" => 'CONFIRMADO'],
            ["nombre_estado" => 'AUTORIZADO'],
            ["nombre_estado" => 'CANCELADO'],
            ["nombre_estado" => 'FINALIZADO']
        ]);
    }
}
