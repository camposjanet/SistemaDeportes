<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BienesPorAlbergue extends Model
{
    //
    protected $table='bienes_por_albergue'; 

    protected $primaryKey='id_bienesxalbergue';
    
    public $timestamps=true;

    protected $fillable = ['id_bienpatrimonial','id_albergue','cantidad_total','cantidad_disponible'];
}
