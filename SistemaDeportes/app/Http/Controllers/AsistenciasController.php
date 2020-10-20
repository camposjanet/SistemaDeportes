<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Ficha;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\session;
use Carbon\Carbon;
use Auth;

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
    public function create()
    {
        $carnet=isset($_GET["nro_carnet"]) ? $_GET["nro_carnet"] : $_POST["nro_carnet"];
        $verifica= Ficha::where("id", $carnet);

        if(!empty($verifica)){
            echo 'exito';
        }else{
            echo 'fracaso';
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
