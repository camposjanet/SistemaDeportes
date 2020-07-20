<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table='telefonos'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = [
        'id_usuario',
        'id_linea_telefonica',
        'id_tipo_telefono'
    ];
}
