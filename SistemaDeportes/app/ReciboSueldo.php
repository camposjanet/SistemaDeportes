<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciboSueldo extends Model
{
    protected $table='recibo_sueldo'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = [
        'id_ficha',
        'id_estado_documento',
        'nro_recibo',
        'fecha_de_presentacion'
        
    ];

    protected $dates = [
        
        'fecha_de_presentacion'
    ];

}
