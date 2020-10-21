<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Ficha;
use App\Planilla_asistencia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\session;
use Carbon\Carbon;
use Auth;
use DB;

class AsistenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Asistencia.MenuAsistencia');
    }

    public function index_cabecera_planilla(){
        $now= Carbon::now();
        $turno=$now->hour;
        //$turno=9;
        $nom_turno=" ";

         if($turno >=8 && $turno <=12){
            $nom_turno="Mañana";
         }
         else{
            if($turno >=16 && $turno <=20){
                $nom_turno="Tarde";
            }else{
                Session::flash('turno','¡¡Lo Sentimos!!. No está habilitado un horario de turno. Recuerde que el horario es 8 a 13 y de 16 a 21 hs');
                return Redirect('/inicio');
            }
         }
        $user= Auth::user();
        $asistencia= Asistencia::where("user_id", $user->id)
                                    ->where("fecha_asistencia",$now->format('Y-m-d'))
                                    ->where("turno",$nom_turno)->first();
        if(empty($asistencia)){
            $asistencia= new Asistencia();
            $asistencia->user_id=$user->id;
            $asistencia->hora_inicio_turno= $now->format('H:i');
            $asistencia->turno=$nom_turno;
            $asistencia->fecha_asistencia= $now->format('Y-m-d');    
            $asistencia->save();

            return view("Asistencia.CabeceraPlanilla",compact("asistencia"));
        }else{
            return view("Asistencia.CabeceraPlanilla",compact("asistencia"));
        } 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $carnet=$_POST['carnet'];
        if(!empty($carnet)){
            $ficha=DB::table('fichas as f')
                    ->join('usuarios as u','f.id_usuario','=','u.id')
                    ->select('f.id', DB::raw('CONCAT(u.apellido," ", u.nombre) AS nombre_apellido'))
                    ->where('f.id','=',$carnet)
                    ->get()
                    ->first();
            $asistencia= new Planilla_asistencia();
            $asistencia->ficha_id= $ficha->id;
            $asistencia->asitencia_id=3;
            $now=Carbon::now();
            $asistencia->hora_ingreso=$now->format('H:i');
            $asistencia->nombre_apellido= $ficha->nombre_apellido;
            $asistencia->save();
            /*if(request()->ajax()){
                return datatabels()->of($asistencia);
            }*/
            return view("Asistencia.CabeceraPlanilla");
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
         /*$registrar_asistencia= DB::table('planilla_asistencia as pa')
                            ->join('asistencias as a','pa.asistencia_id','=','a.id')
                            ->join('fichas as f', 'pa.id_ficha','=','f.id')
                            ->join('usuarios as u','f.id_usuario','=','u.id')
                            ->select('pa.id', 'a.id','f.id', DB::raw('CONCAT(u.apellido, " ",u.nombre) as nombre_apellido','f.ultimo_arancel as fecha_vto')
                            ->get(); 
        if(request()->ajax()){
            return datatables()->on($registrar_asistencia);
        }*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
