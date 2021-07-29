<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notifiacion_email_arancel;

use App\Auth;
use App\Registro_remitentes;
use App\Fichas;
use DB;

use Carbon\Carbon;

class NotificacionArancelController extends Controller
{
    public function index(){
    	$registro=DB::table('registro_remitentes as rr')
        	->join('users as u','rr.user_id','=','u.id')
        	->select('rr.id as id','u.name as name',DB::raw("DATE_FORMAT(rr.fecha_envio,'%d/%m/%Y') as fecha_envio"),DB::raw("DATE_FORMAT(rr.hora_envio,'%H:%i') as hora_envio"))
        	->get();
        if(request()->ajax()){
            return datatables()->of($registro)
                                ->make(true);
        }
    	return view('notificaciones.index');
    }
    public function enviar_correo(){
        set_time_limit(0);
	    $fichas=DB::table('fichas as f')
	        ->join('usuarios as u','f.id_usuario','=','u.id')
	        ->join('estados as e','f.id_estado','=','e.id')
	        ->select('f.id AS id','u.apellido as usuario','u.nombre as nusuario','u.email as email','f.ultimo_arancel','e.estado as estado')
	        ->get();

	    foreach ($fichas as $ficha) {
	    	$fecha_actual=Carbon::now()->format('Y-m-d');
		    if($ficha->ultimo_arancel==NULL){
			    Mail::to($ficha->email)->send(new Notifiacion_email_arancel($ficha));
		    }
		    else{
		    	if($ficha->ultimo_arancel< $fecha_actual){
		    		Mail::to($ficha->email)->send(new Notifiacion_email_arancel($ficha));
		    	}
		    }
		}
    }

    public function create(){
    	return view('notificaciones.create');
    }
    public function store($idUser){
    	$fecha= Carbon::now()->format('Y-m-d');
        $hora=Carbon::now()->format('H:i');

        $this->enviar_correo();
        $remitente=new Registro_remitentes();
        $remitente->user_id=$idUser;
        $remitente->fecha_envio=$fecha;
        $remitente->hora_envio=$hora;

        $remitente->save();
        //return $remitente;
        return Redirect('notificaciones');
    }
}
