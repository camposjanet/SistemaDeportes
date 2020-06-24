<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
App\Http\Controllers\App;

class AdministradorController extends Controller
{
    public function __construct(){
		
		$this->middleware('EsAdmin');
		$this->middleware('EsAdministrativo');
		$this->middleware('EsProfesor');

	}

	public function index(){
		$user=User; 
	
		return "Si has llegado hasta aqui tienes rol de ".$user->roles->nombre_rol;
	}
}
