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
        'fecha_de_vencimiento'
    ];

    protected $dates = [
        'fecha_de_pago',
        'fecha_de_vencimiento'
    ];
}
