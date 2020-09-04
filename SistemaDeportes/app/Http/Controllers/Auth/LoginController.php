<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DB;

class LoginController extends Controller
{
	/*public function __construct(){
		$this->middleware('guest',['only'=>'showLoginForm']);
	} */
	public function showLoginForm(){
		return view('auth.login');
	}
    public function login()
	{
		$credentials= $this->validate(request(),[
			'name'=> 'required|string',
			'password' => 'required|string',
		]);
		
		if(Auth::attempt($credentials))
		{
			$idEstado=DB::table('estados as e')->where('e.estado','=','INACTIVO')->value('id');	
			if(Auth::user()->id_estado == $idEstado){
				Session::flash('no_valido','¡¡Lo sentimos!! El usuario ya no pertenece al Sistema, contactese con los Administradores.');
				return redirect('/');
			}else{
				return redirect()->route('inicio');
			}
		}
		
		return back()
			->withErrors(['name'=>'Usuario Incorrecto','password'=>'constraseña Incorrecta'])
			->withInput(request(['name','password']));
	}
	
	public function logout(){
		Auth::logout();
		return redirect('/');
	}

}
