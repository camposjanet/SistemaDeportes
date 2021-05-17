<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArancelPorCategoria extends Model
{
    protected $table='arancel_por_categoria'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = [
        'id_categoria',
        'id_tipo_de_arancel',
        'estado',
        'importe',
        'fecha_de_registro',
        'numero_de_resolucion'
    ];

    protected $dates = [
        'fecha_de_registro'
    ];
}
