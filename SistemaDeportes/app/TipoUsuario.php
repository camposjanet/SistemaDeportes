<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table='tipos_de_usuario'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = ['tipo'];

    public function socios()
    {
        return $this->hasMany('App\Socio');
    }
}
