<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Role;

class AdministradorController extends Controller
{
    public function __construct(){
		
		$this->middleware('EsAdmin');
		$this->middleware('EsAdministrativo');
		$this->middleware('EsProfesor');

	}

	public function index(){
		$user= user::find(1);
		if($user && $user->roles->nombre_rol="Profesor"){
					
					return "si llegamos hasta aqui es porque sos un usuario ".$user->roles->nombre_rol;
		}	
	}
}
