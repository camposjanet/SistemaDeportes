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
        DB::table('categorias')->insert([
            [
                "categoria" => 'Estudiante'
            ],
            [
                "categoria" => 'Docente'
            ],
            [
                "categoria" => 'PAU'
            ],
            [
                "categoria" => 'Familiar'
            ]
        ]);
        DB::table('unidades_academicas')->insert([
            [
                "unidad" => 'Facultad de Cs. Exactas'
            ],
            [
                "unidad" => 'Facultad de Cs. Económicas '
            ],
            [
                "unidad" => 'Facultad de Humanidades'
            ],
            [
                "unidad" => 'Facultad de Ingeniería'
            ],
            [
                "unidad" => 'Facultad de Cs. Naturales'
            ],
            [
                "unidad" => 'Facultad de Cs. de la Salud'
            ],
            [
                "unidad" => 'Sede Regional Orán'
            ],
            [
                "unidad" => 'Sede Regional Tartagal'
            ],
            [
                "unidad" => 'Sede Regional Metan - Rosario de la Frontera'
            ],
            [
                "unidad" => 'Sede Regional Tartagal - SVE'
            ],
            [
                "unidad" => 'IEM - Salta'
            ],
            [
                "unidad" => 'IEM - Tartagal'
            ]
        ]);
        DB::table('estados')->insert([
            [
                "estado" => 'ACTIVO'
            ],
            [
                "estado" => 'INACTIVO'
            ]
        ]);	
        
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        
        DB::table('lineas_telefonica')->insert([
            ["linea" => 'Personal'],
            ["linea" => 'Claro'],
            ["linea" => 'Movistar'],
            ["linea" => 'Movicom'],
            ["linea" => 'Unifon'],
            ["linea" => 'NEXTEL'],
            ["linea" => 'SKYTEL'],
            ["linea" => 'CTI'],
            ["linea" => 'Otra']
        ]);

        DB::table('estados_de_documento')->insert([
            ["estado" => 'PRESENTO'],
            ["estado" => 'NO PRESENTO'],
            ["estado" => 'VENCIDO']
        ]);

	}
}
