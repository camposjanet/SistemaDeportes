<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $table='fichas'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = [
        'id_usuario',
        'id_categoria',
        'lu_legajo',
        'id_unidad_academica',
        'lugar_de_trabajo',
        'estado_documentacion',
        'id_estado'
        
    ];

    protected $dates = [
        
        
    ];
}
