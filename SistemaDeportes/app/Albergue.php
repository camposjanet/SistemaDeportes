<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albergue extends Model
{
    protected $table='albergue'; 

    protected $primaryKey='id';
    
    public $timestamps=false;
}
