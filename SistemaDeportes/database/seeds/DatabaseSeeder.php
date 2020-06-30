<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('tipo_de_socio')->insert([
            [
                "tipo" => 'Estudiante'
            ],
            [
                "tipo" => 'Docente'
            ],
            [
                "tipo" => 'PAU'
            ],
            [
                "tipo" => 'Familiar'
            ]
        ]);
        DB::table('facultad')->insert([
            [
                "nombre" => 'Facultad de Cs. Exactas'
            ],
            [
                "nombre" => 'Facultad de Cs. Económicas '
            ],
            [
                "nombre" => 'Facultad de Humanidades'
            ],
            [
                "nombre" => 'Facultad de Ingeniería'
            ],
            [
                "nombre" => 'Facultad de Cs. Naturales'
            ],
            [
                "nombre" => 'Facultad de Cs. de la Salud'
            ]
        ]);
    }
}
