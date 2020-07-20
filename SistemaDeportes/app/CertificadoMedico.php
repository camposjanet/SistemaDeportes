<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificadoMedico extends Model
{
    protected $table='certificado_medico'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = [
        'id_ficha',
        'id_estado_documento',
        'fecha_de_emision',
        'nombre_medico'
        
    ];

    protected $dates = [
        
        'fecha_de_emision'
    ];
}
