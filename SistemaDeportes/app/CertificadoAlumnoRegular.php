<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificadoAlumnoRegular extends Model
{
    protected $table='certificado_alumno_regular'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = [
        'id_ficha',
        'id_estado_documento',
        'fecha_de_vencimiento',
        'fecha_de_presentacion'
        
    ];

    protected $dates = [
        
        'fecha_de_vencimiento',
        'fecha_de_presentacion'
    ];
}
