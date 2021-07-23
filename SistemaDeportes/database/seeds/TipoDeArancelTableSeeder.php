<?php

use Illuminate\Database\Seeder;

class TipoDeArancelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_de_arancel')->insert([
            ["nombre" => 'SALA DE MUSCULACION'],
            ["nombre" => 'ALBERGUE UNIVERSITARIO']
        ]);
    }
}
