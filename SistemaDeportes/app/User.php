<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','id_estado',
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

	public function roles(){
		return $this->belongsToMany('App\Role');
	}

    public function asistencias(){
        return $this->hasmany('App\Asistencia');
    }
	
	public function esAdmin(){
		if($this->role->nombre_rol=='Administrador'){
			return true;
        }
		return false;
	}

	public function esOperario(){
		if($this->role->nombre_rol=='Operario'){
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
