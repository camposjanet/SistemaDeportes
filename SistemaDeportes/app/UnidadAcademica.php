<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadAcademica extends Model
{
    protected $table='unidades_academicas'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = ['unidad'];
}
