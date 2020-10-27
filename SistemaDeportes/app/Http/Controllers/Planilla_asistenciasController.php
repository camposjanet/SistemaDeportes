<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistencia;
use App\Ficha;
use App\Planilla_asistencia;

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
    public function mostar_fichas($id){
        $usuario =Usuario::findOrFail($id);
        $now=Carbon::now();
        $hora=$now->hour;
        $fecha_ingreso=$now->format('Y-m-d');
        $fichas = DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->select('f.id AS id',raw('CONCAT(u.apellido, " ",u.nombre)AS nombre_usuario'),'u.dni AS dni')
        ->where('f.id_usuario',$usuario->id)
        ->first()
        ->get();

       if(request()->ajax()){
            return reponse()->json([
                'id'=> $fichas->id,
                'nombre_usuario'=> $fichas->nombre_usuario,
                'dni'=> $fichas->dni,
                'fecha'=>$fecha_ingreso,
                'hora_ingreso'=>$hora
            ]);
        }
    }
    public function create($id)
    {
        
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
