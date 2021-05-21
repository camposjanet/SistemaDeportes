<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arancel extends Model
{
    protected $table='aranceles'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = [
        'id_ficha',
        'id_user',
        'importe',
        'fecha_de_pago',
        'fecha_de_vencimiento',
        'nro_recibo',
        'fecha_de_inicio',
        'cantidad_meses'
    ];

    protected $dates = [
        'fecha_de_pago',
        'fecha_de_vencimiento',
        'fecha_de_inicio'
    ];
}
