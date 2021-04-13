<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioRequest;
use App\Usuario;
use App\LineaTelefonica;
use App\Estados;
use App\Telefono;

use DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

use Yajra\Datatables\Datatables;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
	{
        $lineas=LineaTelefonica::all()->pluck('linea','id')->ToArray();
		return view("usuario.create")->with('lineas',$lineas);
	}

	public function store(UsuarioRequest $request)
	{
        $idEstado=DB::table('estados as e')->where('e.estado','=','ACTIVO')->value('id');

        $usuario = new Usuario($request->all());
        $mytime1 = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_nacimiento'));
        $usuario->fecha_de_nacimiento = $mytime1->toDateString();
        if($request->file('foto')){
            $file =$request->file('foto');
            $extension=$file->getClientOriginalName();//nombre de img
            $path=public_path().'/img/usuarios/';//donde guardamos img
            $file->move($path,$extension);//guardar imagen
            $usuario->foto=$extension;
        }
		$usuario->id_estado = $idEstado;
        if ( $usuario->save())
        {
            $telefono = new Telefono;
            $telefono->id_usuario = $usuario->id;
            $id_linea_telefono = $request->get('id_linea_telefono');
            $telefono->numero = $request->get('telefono_celular');
            $telefono->tipo_telefono = 'TELEFONO';
            $telefono->id_linea_telefonica = $id_linea_telefono;
            $telefono->save();

            $contacto = new Telefono;
            $contacto->id_usuario = $usuario->id;
            $contacto->numero = $request->get('telefono_de_emergencia');
            $contacto->id_linea_telefonica = $request->get('id_linea_telefono_emergencia');
            $contacto->tipo_telefono = 'CONTACTO DE EMERGENCIA';
            $contacto->save(); 
            return Redirect::to('ficha/create/'.$usuario->id);
        } 
        
    }
    public function index()
    {
        
        $usuarios=DB::table('usuarios as u')
        ->join('estados as e','u.id_estado','=','e.id')
        ->join('telefonos as t','u.id','=','t.id_usuario')
        ->select('u.id','apellido','nombre','dni','e.estado as estado','categoria','t.numero as telefono')
        ->where('t.tipo_telefono','=','TELEFONO')
        ->get();

        if(request()->ajax()) {
            return datatables()->of($usuarios)
            ->addColumn('action', 'usuario.action_buton')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('usuario.index');
    }

    public function deleteUsuario($id)
    {
        $usuario =Usuario::findOrFail($id);
        $idEstadoInactivo=DB::table('estados as e')->where('e.estado','=','INACTIVO')->value('id');
    	$usuario->id_estado=$idEstadoInactivo;
    	$usuario->update();
    	return Redirect::to('usuarios');
    }
}
