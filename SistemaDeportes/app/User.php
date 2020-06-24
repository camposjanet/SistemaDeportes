<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','dni',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
