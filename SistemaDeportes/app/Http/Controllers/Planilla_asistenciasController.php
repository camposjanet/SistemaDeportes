<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use App\Asistencia;
use App\Ficha;
use App\Planilla_asistencia;
use App\CertificadoAlumnoRegular;
use App\CertificadoMedico;
use App\DocumentacionFamiliar;
use App\ReciboSueldo;



use Carbon\Carbon;
use DB;
use Reponse;

class Planilla_asistenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrar_fichas($id){
        $esUsuarioValido=false;
        $now=Carbon::now();
        $hora=Carbon::now()->format('H:m');
        $fichas=DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->select('f.id AS id',DB::raw('CONCAT(u.apellido, " ",u.nombre)AS nombre_usuario'),'u.dni AS dni','f.ultimo_arancel AS fecha_pago','f.id_categoria')
        ->where('f.id',$id)
        ->first();

        //Comprueba el estado de la documentación y del Usuario
        /*$idEstado=DB::table('estados as e')->where('e.estado','=','ACTIVO')->value('id');
        $verifica= DB::table('fichas as f')
                        ->where('f.id','=',$id)
                        ->where('f.id_estado','=',$idEstado)
                        ->where('f.estado_documentacion','=','COMPLETA')
                        ->first();         
        if(!empty($verifica)){
            $fecha_actual=Carbon::now()->format('Y-m-d');
            if($fecha_actual <= $fichas->fecha_pago){
                $esUsuarioValido=true;
            }else{
                $esUsuarioValido=false;
            } 
        }*/
        $fecha_actual=Carbon::now()->format('Y-m-d');
        if($fichas->id_categoria==1){
            $documentacion= CertificadoAlumnoRegular::where('id_ficha',$fichas->id)->first();
            if(!empty($docuemtacion->fecha_de_vencimiento)){
                if($documentacion->fecha_de_vencimiento>= $fecha_actual){
                    $esUsuarioValido=true;
                }else{
                    $esUsuarioValido=false;
                } 
            }else{
                $esUsuarioValido=false;
            }
        }else{
            if ($fichas->id_categoria==2 || $fichas->id_categoria==3 || $fichas->id_categoria==4){
                $documentacion= ReciboSueldo::where('id_ficha',$fichas->id)->first();
                //$anio = date("Y");
                //$fecha_vto=Carbon::createFromDate($anio,'03','31')->addYear(); 
                if(!empty($docuemtacion->fecha_de_presentacion)){
                    /*if($fecha_actual<= $fecha_vto){
                        $esUsuarioValido=true;
                    }else{
                        $esUsuarioValido=false;
                    }*/
                    $esUsuarioValido=true;
                }else{
                    $esUsuarioValido=false;
                }
            }
        }
        $cert_med= CertificadoMedico::where('id_ficha',$fichas->id)->first();
        if(!empty($cert_med)){
            if($cert_med->fecha_de_vencimiento>= $fecha_actual){
                $esUsuarioValido=true;
            }else{
                $esUsuarioValido=false;
            }
        }else{
            $esUsuarioValido=false;
        }
        if($fecha_actual<= $fichas->fecha_pago){
            $esUsuarioValido=true;
        }else{
            $esUsuarioValido=false;
        }
        return response()->json([
            'fichas'=> $fichas,
            'hora_ingreso'=>$hora,
            'UsuarioValido'=> $esUsuarioValido
        ]); 
    }
    public function estado_documentacion($id){
        $ficha=Ficha::findOrFail($id);
        $fecha= Carbon::now()->format('Y-m-d');
        $categoria=" ";
        if(!empty($ficha)){
            if($ficha->id_categoria==1){
                $categoria= "CONSTANCIA DE ALUMNO REGULAR";
                $documentacion=CertificadoAlumnoRegular::where('id_ficha',$ficha->id)->first();
                if(empty($documentacion->fecha_de_vencimiento)){
                    $estado= "NO PRESENTO";
                    $color_documentacion= "red";
                } elseif ($documentacion->fecha_de_vencimiento< $fecha) {
                    $estado=$documentacion->fecha_de_vencimiento->format('d-m-Y');
                    $color_documentacion="red";
                }else{
                    $estado= $documentacion->fecha_de_vencimiento->format('d-m-Y');
                    $color_documentacion="green";
                }
                
                $certmedico=CertificadoMedico::where('id_ficha',$ficha->id)->first();
                if(empty($certmedico->fecha_de_vencimiento)){
                    $estadomed= "NO PRESENTO";
                    $color_certmed="red";
                } elseif ($certmedico->fecha_de_vencimiento< $fecha) {
                    $estadomed=$certmedico->fecha_de_vencimiento->format('d-m-Y');
                    $color_certmed="red";
                }else{
                    $estadomed= $certmedico->fecha_de_vencimiento->format('d-m-Y');
                    $color_certmed="green";
                }

                if($ficha->ultimo_arancel== null){
                    $estadofecha="NO PRESENTO";
                    $color_arancel="red";
                }elseif ($ficha->ultimo_arancel < $fecha) {
                    $estadofecha=$ficha->ultimo_arancel->format('d-m-Y');
                    $color_arancel="red";
                }else{
                    $estadofecha= $ficha->ultimo_arancel->format('d-m-Y');
                    $color_arancel="green";
                }
            }elseif ($ficha->id_categoria==2 || $ficha->id_categoria==3 || $ficha->id_categoria==4) {
                $categoria= "RECIBO DE SUELDO";
                $documentacion=ReciboSueldo::where('id_ficha',$ficha->id)->first();
                if(empty($documentacion->fecha_de_presentacion)){
                    $estado= "NO PRESENTO";
                    $color_documentacion="red";
                } elseif ($documentacion->fecha_de_presentacion < $fecha) {
                    $estado=$documentacion->fecha_de_presentacion->format('d-m-Y');
                    $color_documentacion="red";
                }else{
                    $estado= "PRESENTO";
                    $color_documentacion="green";
                }
                
                $certmedico=CertificadoMedico::where('id_ficha',$ficha->id)->first();
                if(empty($certmedico->fecha_de_vencimiento)){
                    $estadomed= "NO PRESENTO";
                    $color_certmed="red";
                } elseif ($certmedico->fecha_de_vencimiento< $fecha) {
                    $estadomed=$certmedico->fecha_de_vencimiento->format('d-m-Y');
                    $color_certmed="red";
                }else{
                    $estadomed= $certmedico->fecha_de_vencimiento->format('d-m-Y');
                    $color_certmed="green";
                }

                if(empty($ficha->ultimo_arancel)){
                    $estadofecha="NO PRESENTO";
                    $color_arancel="red";
                }elseif ($ficha->ultimo_arancel < $fecha) {
                    $estadofecha=$ficha->ultimo_arancel->format('d-m-Y');
                    $color_arancel="red";
                }else{
                    $estadofecha= $ficha->ultimo_arancel->format('d-m-Y');
                    $color_arancel="green";
                }
            }
        }

        return response()->json([
            'color_documentacion'=>$color_documentacion,
            'color_certmed'=> $color_certmed,
            'color_arancel'=>$color_arancel,
            'categoria'=> $categoria,
            'documentacion'=> $estado,
            'certificado_medico'=> $estadomed,
            'ultimo_arancel'=> $estadofecha
        ]); 
    }
    public function create($idAsistencia, $idficha)
    {
        $hora= Carbon::now()->format('H:m');

        $Planilla_asistencia= new Planilla_asistencia();
        $Planilla_asistencia->ficha_id= $idficha;
        $Planilla_asistencia->asistencia_id= $idAsistencia;
        $Planilla_asistencia->hora_ingreso= $hora;

        $Planilla_asistencia->save();
    }
    public function mostrar_asistencia_turno(){
        $fecha= Carbon::now()->format('Y-m-d');
        $hora= Carbon::now()->hour;
        //$hora= 12;
        $turno= " ";
        if($hora>= 8 && $hora<=12){
            $turno="Mañana";
        }elseif ($hora>= 16 && $hora<=20) {
            $turno="Tarde";
        }
        $asistencia=DB::table('planilla_asistencias as pa')
                        ->join('asistencias as a','pa.asistencia_id','=','a.id')
                        ->join('fichas as f','pa.ficha_id','=','f.id')
                        ->join('usuarios as u','f.id_usuario','=','u.id')
                        ->select('pa.id','pa.ficha_id',DB::raw('CONCAT(u.nombre," ",u.apellido)AS nombre_usuario'),'u.dni','pa.hora_ingreso','f.ultimo_arancel')
                        ->where('a.turno','=',$turno)
                        ->where('a.fecha_asistencia','=',$fecha)                        
                        ->get(); 
        if(request()->ajax()){
            return datatables()->of($asistencia)
                                ->make(true);
        }
    }

    public function mostrar_asistencia($id){
        $asistencia= DB::table('planilla_asistencias as pa')
                            ->join('asistencias as a','pa.asistencia_id','=','a.id')
                            ->join('fichas as f', 'pa.ficha_id','=','f.id')
                            ->join('usuarios as u','f.id_usuario','=','u.id')
                            ->select('pa.asistencia_id','pa.id','pa.ficha_id',DB::raw('CONCAT(u.nombre," ",u.apellido)AS nombre_usuario'),'u.dni','pa.hora_ingreso','f.ultimo_arancel')
                            ->where('pa.asistencia_id','=',$id)
                            ->get();

        if(request()->ajax()){
            return datatables()->of($asistencia)
                                ->make(true);
        }


    }

    public function buscar_asistencia($id){
        $cabecera= DB::table('asistencias as a', 'pa.asistencia_id','=','a.id')
                        ->join('users as u','a.user_id','=','u.id')
                        ->select('a.id','u.name', 'a.turno','a.fecha_asistencia')
                        ->where('a.id', $id)
                        ->first(); 
        if(!empty($cabecera)){
            return view('Asistencia.verCabecera',compact('cabecera'));
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
