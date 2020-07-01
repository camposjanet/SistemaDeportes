<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	public function __construct(){
		$this->middleware('guest',['only'=>'showLoginForm']);
	}
	public function showLoginForm(){
		return view('auth.login');
	}
    public function login()
	{
		$credentials= $this->validate(request(),[
			'name'=> 'required|string',
			'password' => 'required|string'
		]);
		
		if(Auth::attempt($credentials))
		{
			return redirect()->route('inicio');
		}
		
		return back()
			->withErrors(['name'=>'No se encuentra registo del nombre de ususario ingresado'])
			->withInput(request(['name']));


	}
	
	public function logout(){
		Auth::logout();
		return redirect('/');
	}

}
