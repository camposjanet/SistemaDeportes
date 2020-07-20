<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuarios'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
    	'domicilio',
        'email',
        'id_estado',
        'foto',
        'fecha_de_nacimiento'
        
    ];

    protected $dates = [
        
        'fecha_de_nacimiento'
    ];
}
