<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BienesPatrimoniales extends Model
{
    protected $table='bienes_patrimoniales'; 

    protected $primaryKey='id_bienpatrimonial';
    
    public $timestamps=true;

    protected $fillable = ['nombre_bienpatrimonial'];
}
