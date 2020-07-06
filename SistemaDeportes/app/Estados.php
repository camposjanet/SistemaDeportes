<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $table='estados'; 

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable = ['estado'];
}
