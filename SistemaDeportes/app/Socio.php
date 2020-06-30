<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    protected $table='socios'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = [
    	'nombre_apellido',
        'dni',
        'lu_legajo',
    	'domicilio',
    	'telefono_celular',
    	'telefono_de_emergencia',
        'email',
        'estado',
        'id_tipo_socio',
        'certificado_de_alumno',
        'id_facultad',
        'lugar_de_trabajo',
        'foto',
        'fecha_de_nacimiento'
        
    ];

    protected $dates = [
        
        'fecha_de_nacimiento'
    ];
}
