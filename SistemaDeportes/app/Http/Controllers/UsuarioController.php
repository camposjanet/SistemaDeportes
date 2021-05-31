<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\EditUsuarioRequest;
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

    public function edit($id){
        //$lineas=LineaTelefonica::all()->pluck('linea','id')->ToArray();
        $lineas=DB::table('lineas_telefonica')->get();
        $usuario=DB::table('usuarios as u')
        ->join('telefonos as t','t.id_usuario','=','u.id')
        ->join('lineas_telefonica as lt','t.id_linea_telefonica','=','lt.id')
        ->select('u.id','apellido','u.nombre','dni','u.fecha_de_nacimiento','u.domicilio','u.email','u.foto as foto')
        ->where('u.id','=',$id)
        ->first();
        $telefono_celular=DB::table('telefonos as t')
                            ->join('lineas_telefonica as lt','lt.id','=','t.id_linea_telefonica')
                            ->select('t.numero as numero','lt.id as id_celular','lt.linea as linea')
                            ->where('t.id_usuario','=',$id)
                            ->where('t.tipo_telefono','=','TELEFONO')
                            ->first();
        $telefono_de_emergencia=DB::table('telefonos as t')
                            ->join('lineas_telefonica as lt','lt.id','=','t.id_linea_telefonica')
                            ->select('t.numero as numero','lt.id as id_emergencia','lt.linea as linea')
                            ->where('t.id_usuario','=',$id)
                            ->where('t.tipo_telefono','=','CONTACTO DE EMERGENCIA')
                            ->first();
        return view("usuario.edit")->with('usuario',$usuario)
                                    ->with('lineas', $lineas)
                                    ->with('telefono_celular',$telefono_celular)
                                    ->with('telefono_de_emergencia',$telefono_de_emergencia);
    }

    public function update_usuario(Request $request, $id){
                $usuario=Usuario::findOrFail($id);
                if($request->hasFile('foto')){
                    $file =$request->file('foto');
                    $extension=$file->getClientOriginalName();//nombre de img
                    $path=public_path().'/img/usuarios/';//donde guardamos img
                    $file->move($path,$extension);//guardar imagen
                    $usuario->update([
                    'nombre'=>$request->get('nombre'),
                    'apellido'=>$request->get('apellido'),
                    'fecha_de_nacimiento'=>$request->get('fecha_de_nacimiento'),
                    'dni'=>$request->get('dni'),
                    'email'=>$request->get('email'),
                    'domicilio'=>$request->get('domicilio'),
                    'foto'=>$extension
                    ]); 
                }else{
                    $usuario->update([
                        'nombre'=>$request->get('nombre'),
                        'apellido'=>$request->get('apellido'),
                        'fecha_de_nacimiento'=>$request->get('fecha_de_nacimiento'),
                        'dni'=>$request->get('dni'),
                        'email'=>$request->get('email'),
                        'domicilio'=>$request->get('domicilio')
                    ]);    
                }
                 
                $telefono_contacto=Telefono::where('id_usuario','=',$id)->where('tipo_telefono','=','TELEFONO');
                $telefono_contacto->update([
                    'numero'=>$request->input('telefono_celular'),
                    'id_linea_telefonica'=>$request->input('telcontacto')
                ]); 
                
                $telefono_emergencia=Telefono::where('id_usuario','=',$id)->where('tipo_telefono','=','CONTACTO DE EMERGENCIA');
                $telefono_emergencia->update([
                    'numero'=>$request->input('telefono_de_emergencia'),
                    'id_linea_telefonica'=>$request->input('telemergencia')
                ]);
                return Redirect::to('usuarios');
    }
}
