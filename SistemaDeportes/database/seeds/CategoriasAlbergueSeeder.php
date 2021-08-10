<?php

use Illuminate\Database\Seeder;

class CategoriasAlbergueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            // ["categoria" => 'Público en general',"tipo" => 'SALA DE MUSCULACIÓN'],
            ["categoria" => 'Estudiantes de las Sedes',"tipo" => 'ALBERGUE UNIVERSITARIO'],
            ["categoria" => 'Estudiantes/Docentes y Personal Administrativo de otras Universidades',"tipo" => 'ALBERGUE UNIVERSITARIO'],
            ["categoria" => 'Público en general y demás instituciones',"tipo" => 'ALBERGUE UNIVERSITARIO']
        ]);
    }
}
