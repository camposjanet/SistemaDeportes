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
        $hora=$now->format('H:m');
        $fichas = DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->select('f.id AS id',DB::raw('CONCAT(u.apellido, " ",u.nombre)AS nombre_usuario'),'u.dni AS dni','f.ultimo_arancel AS fecha_pago')
        ->where('f.id',$id)
        ->first();

        //Comprueba el estado de la documentación y del Usuario
        $idEstado=DB::table('estados as e')->where('e.estado','=','ACTIVO')->value('id');
        $verifica= DB::table('fichas as f')
                        ->where('f.id','=',$id)
                        ->where('f.id_estado','=',$idEstado)
                        ->where('f.estado_documentacion','=','COMPLETA')
                        ->first();
        if(empty($verifica)){
            $fecha_actual=Carbon::now()->format('Y-m-d');
            if($fecha_actual <= $fichas->fecha_pago){
                $esUsuarioValido=true;
            }else{
                $esUsuarioValido=false;
            } 
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
                if($documentacion->fecha_vencimiento)== null){
                    $estado= "NO PRESENTÓ";
                } elseif ($docuemtacion->fecha_vencimiento< $fecha) {
                    $estado="VENCIDA";
                }else{
                    $estado= "PRESENTÓ";
                }
                
                $certmedico=CertificadoMedico::where('id_ficha',$ficha->id)->first();
                if($certmedico->fecha_vencimiento)== null){
                    $estadomed= "NO PRESENTÓ";
                } elseif ($certmedico->fecha_vencimiento< $fecha) {
                    $estadomed="VENCIDA";
                }else{
                    $estadomed= "PRESENTÓ";
                }

                if($ficha->ultimo_arancel== null){
                    $estadofecha="NO PRESENTO";
                }elseif ($ficha->ultimo_arancel < $fecha) {
                    $estadofecha="VENCIDA";
                }else{
                    $estadofecha= "PRESENTÓ";
                }
            }elseif ($ficha->id_categoria==2) {
                $categoria= "RECIBO DE SUELDO";

                $documentacion=ReciboSueldo::where('id_ficha',$ficha->id)->first();
                if($documentacion->fecha_vencimiento)== null){
                    $estado= "NO PRESENTÓ";
                } elseif ($docuemtacion->fecha_vencimiento< $fecha) {
                    $estado="VENCIDA";
                }else{
                    $estado= "PRESENTÓ";
                }
                
                $certmedico=CertificadoMedico::where('id_ficha',$ficha->id)->first();
                if($certmedico->fecha_vencimiento)== null){
                    $estadomed= "NO PRESENTÓ";
                } elseif ($certmedico->fecha_vencimiento< $fecha) {
                    $estadomed="VENCIDA";
                }else{
                    $estadomed= "PRESENTÓ";
                }

                if($ficha->ultimo_arancel== null){
                    $estadofecha="NO PRESENTO";
                }elseif ($ficha->ultimo_arancel < $fecha) {
                    $estadofecha="VENCIDA";
                }else{
                    $estadofecha= "PRESENTÓ";
                }

            }elseif ($ficha->id_categoria==3) {
                $categoria= "RECIBO DE SUELDO";

                $documentacion=ReciboSueldo::where('id_ficha',$ficha->id)->first();
                if($documentacion->fecha_vencimiento)== null){
                    $estado= "NO PRESENTÓ";
                } elseif ($docuemtacion->fecha_vencimiento< $fecha) {
                    $estado="VENCIDA";
                }else{
                    $estado= "PRESENTÓ";
                }
                
                $certmedico=CertificadoMedico::where('id_ficha',$ficha->id)->first();
                if($certmedico->fecha_vencimiento)== null){
                    $estadomed= "NO PRESENTÓ";
                } elseif ($certmedico->fecha_vencimiento< $fecha) {
                    $estadomed="VENCIDA";
                }else{
                    $estadomed= "PRESENTÓ";
                }

                if($ficha->ultimo_arancel== null){
                    $estadofecha="NO PRESENTO";
                }elseif ($ficha->ultimo_arancel < $fecha) {
                    $estadofecha="VENCIDA";
                }else{
                    $estadofecha= "PRESENTÓ";
                }
            }elseif ($ficha->id_categoria==4) {
                $categoria= "RECIBO DE SUELDO";

                $documentacion=ReciboSueldo::where('id_ficha',$ficha->id)->first();
                if($documentacion->fecha_vencimiento)== null){
                    $estado= "NO PRESENTÓ";
                } elseif ($docuemtacion->fecha_vencimiento< $fecha) {
                    $estado="VENCIDA";
                }else{
                    $estado= "PRESENTÓ";
                }
                
                $certmedico=CertificadoMedico::where('id_ficha',$ficha->id)->first();
                if($certmedico->fecha_vencimiento)== null){
                    $estadomed= "NO PRESENTÓ";
                } elseif ($certmedico->fecha_vencimiento< $fecha) {
                    $estadomed="VENCIDA";
                }else{
                    $estadomed= "PRESENTÓ";
                }

                if($ficha->ultimo_arancel== null){
                    $estadofecha="NO PRESENTO";
                }elseif ($ficha->ultimo_arancel < $fecha) {
                    $estadofecha="VENCIDA";
                }else{
                    $estadofecha= "PRESENTÓ";
                }
            }
        }

        return response()->json([
            'categoria'=> $categoria,
            'documentacion'=> $estado,
            'certificado_medico'=> $estadomed,
            'ultimo_arancel'=> $estadofecha
        ]);
    }
    public function create($idAsistencia, $idficha)
    {
        $hora= Carbon::now();

        $Planilla_asistencia= new Planilla_asistencia();
        $Planilla_asistencia->ficha_id= $idficha;
        $Planilla_asistencia->asistencia_id= $idAsistencia;
        $Planilla_asistencia->hora_ingreso= $hora->format('H:m');

        $Planilla_asistencia->save();
       
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
