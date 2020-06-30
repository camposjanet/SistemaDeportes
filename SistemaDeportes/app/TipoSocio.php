<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSocio extends Model
{
    protected $table='tipo_de_socio'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = ['tipo'];

    public function socios()
    {
        return $this->hasMany('App\Socio');
    }
}
