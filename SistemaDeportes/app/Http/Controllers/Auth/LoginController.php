<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auht;

class LoginController extends Controller
{
    public function login()
	{
		$credentials=$this->validate(request(),[
			'Usuario'=> 'nombre_rol|required|string',
			'Password' => 'required|string'
		]);
		
		return $credentials;
		/*if(Auth::attempt($credentials))
		{
			return redirect()->route('dashboard');
		}
		
		return back()->withErrors(['email'=>'El correo ingresado no se encuentra '])
					 ->withInput(request(['email']));
		*/

	}

}
