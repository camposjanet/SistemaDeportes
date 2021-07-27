<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


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
        $ficha_existe=false;
        $now=Carbon::now();
        $hora=Carbon::now()->format('H:i');
        

        $fichas=DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->join('estados as e','f.id_estado','=','e.id')
        ->select('f.id AS id',DB::raw('CONCAT(u.apellido, " ",u.nombre)AS nombre_usuario'),'u.dni AS dni','f.id_categoria','f.ultimo_arancel','e.estado as estado')
        ->where('f.id',$id)
        ->first();

        //Comprueba el estado de la documentación y del Usuario
        $fecha_actual=Carbon::now()->format('Y-m-d');
        if(isset($fichas)){
            //$esUsuarioValido=false;
            $ficha_existe=true;
            if($fichas->estado == 'ACTIVO'){
                $ficha_valida=true;
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
                        if(!empty($docuemtacion->fecha_de_presentacion)){
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
                if($fecha_actual<= $fichas->ultimo_arancel){
                    $esUsuarioValido=true;
                }else{
                    $esUsuarioValido=false;
                }

                /*return response()->json([
                    'fichas'=> $fichas,
                    'hora_ingreso'=>$hora,
                    'UsuarioValido'=> $esUsuarioValido,
                    'ficha_existe'=> $ficha_existe 
                ]); */
            }else{
                //else de estado activo
                //$esUsuarioValido=false;
                $ficha_valida=false;
                Session::flash('error_ficha','El N° de Carnet '.$id.' no se encuentra ACTIVO, por favor vuelva a ingresar un número');
            }
        }else{
            // ficha nula
            $ficha_valida=false;
            Session::flash('error_ficha','No se ha encontrado el N° de Carnet '.$id.' por favor vuelva a ingresar un número');
        }
        return response()->json([
                    'fichas'=> $fichas,
                    'hora_ingreso'=>$hora,
                    'UsuarioValido'=> $esUsuarioValido,
                    'ficha_valida'=> $ficha_valida
        ]);
    }
    public function estado_documentacion($id){
        $ficha=Ficha::find($id);
        $fecha= Carbon::now()->format('Y-m-d');
        $categoria=" ";

        if(isset($ficha)){
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
        }else{
            Session::flash('error_ficha','El N° de carnet '.$id.' no se ha encontrado, por favor ingrese un nuevo N° de carnet');
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
        $hora= Carbon::now()->format('H:i');

        $Planilla_asistencia= new Planilla_asistencia();
        $Planilla_asistencia->ficha_id= $idficha;
        $Planilla_asistencia->asistencia_id= $idAsistencia;
        $Planilla_asistencia->hora_ingreso=$hora;

        $Planilla_asistencia->save();
    }
    public function mostrar_asistencia_turno(){
        $fecha= Carbon::now()->format('Y-m-d');
        $hora= Carbon::now()->hour;
        //$hora= 12;
        $turno= " ";
        if($hora>= 7 && $hora<14){
            $turno="Mañana";
        }elseif ($hora>= 14 && $hora<=20) {
            $turno="Tarde";
        }
        $asistencia=DB::table('planilla_asistencias as pa')
                        ->join('asistencias as a','pa.asistencia_id','=','a.id')
                        ->join('fichas as f','pa.ficha_id','=','f.id')
                        ->join('usuarios as u','f.id_usuario','=','u.id')
                        ->select('pa.id','pa.ficha_id',DB::raw('CONCAT(u.nombre," ",u.apellido)AS nombre_usuario'),'u.dni',DB::raw("DATE_FORMAT(pa.hora_ingreso,'%H:%i') as hora_ingreso"),DB::raw("DATE_FORMAT(f.ultimo_arancel,'%d/%m/%Y') as ultimo_arancel"),'a.fecha_asistencia')
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
                            ->select('pa.asistencia_id','pa.id','pa.ficha_id',DB::raw('CONCAT(u.nombre," ",u.apellido)AS nombre_usuario'),'u.dni',DB::raw("DATE_FORMAT(pa.hora_ingreso,'%H:%i') as hora_ingreso"),DB::raw("DATE_FORMAT(f.ultimo_arancel,'%d/%m/%Y') as ultimo_arancel"))
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
