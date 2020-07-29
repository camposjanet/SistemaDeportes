<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentacionFamiliar extends Model
{
    protected $table='documentacion_familiar'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = [
        'id_ficha',
        'id_estado_documento',
        'nombre_documentacion',
        'fecha_de_presentacion',
        'nombre_familiar',
        'legajo_familiar'
        
    ];

    protected $dates = [
        
        'fecha_de_presentacion'
    ];
}
