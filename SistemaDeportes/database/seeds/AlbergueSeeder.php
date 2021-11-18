<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbergueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('albergue')->insert([
            ["nombre_albergue" => 'ALBERGUE VARONES',"cupo_total"=>18,"cupo_disponible"=>18],
            ["nombre_albergue" => 'ALBERGUE MUJERES',"cupo_total"=>18,"cupo_disponible"=>18]
        ]);
    }
}
