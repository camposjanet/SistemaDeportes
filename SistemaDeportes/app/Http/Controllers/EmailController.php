<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailRecuperarPass;

use App\User;
use DB;

class EmailController extends Controller
{
    function generateRandomString($length = 8) { 
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    }

    public function create(){
        
		return view("auth.email_recuperar_password.create");
    }
    public function sendEmail(Request $request){

        $correo = $request->get('email');
        $name = $request->get('name');
        
        $user = DB::table('users as u')
                ->select('id','name','email')
                ->where('u.name',$name)
                ->orwhere('u.email',$correo)
                ->first();
        if ($user != null){
            $datos = new \stdClass();
            $datos->cadena_aleatoria = $this->generateRandomString();
            $users=User::findOrFail($user->id);
            $users->update(['password'=>bcrypt($datos->cadena_aleatoria),'estado_contrasenia'=>false]);
            $datos->name = $user->name;

            Mail::to($user->email)->send(new SendEmailRecuperarPass($datos));

            return view("auth.email_recuperar_password.email_enviado")->with('user',$user);
        } else {
            Session::flash('datos_erroneos','El nombre de usuario y/o correo electrónico no se encuentran registrados, por favor comunicarse con el Administrador.');
            return Redirect::back();
        }
        
	}
}
