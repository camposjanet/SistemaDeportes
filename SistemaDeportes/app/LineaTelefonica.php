<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineaTelefonica extends Model
{
    protected $table='lineas_telefonica'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = ['linea'];
}
