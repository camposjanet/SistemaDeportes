<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    public function role(){
		return $this->belongsToMany('App\Role');
	}
	
	public function esAdmin(){
		if($this->role->nombre_rol=='Administrador'){
			return true;
		}

		return false;
	}

	public function esAdministrativo(){
		if($this->role->nombre_rol=='Administrativo'){
			return true;
		}

		return false;
	}
	
	public function esProfesor(){
		if($this->role->nombre_rol=='Profesor'){
			return true;
		}

		return false;
	}
}
