<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDeArancel extends Model
{
    protected $table='tipo_de_arancel'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = ['nombre'];
}
