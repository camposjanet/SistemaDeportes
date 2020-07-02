<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SocioRequest;
use App\Socio;
use App\TipoSocio;
use App\Estados;

use DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

use Yajra\Datatables\Datatables;

class SocioController extends Controller
{
    public function create()
	{
        $facultades=DB::table('facultad')->get();
        $tipos=TipoSocio::all()->pluck('tipo','id')->ToArray();
		return view("socio.create")->with('tipos',$tipos)
                                    ->with('facultades',$facultades);
	}

	public function store(SocioRequest $request)
	{
        $idEstado=DB::table('estados as e')->where('e.estado','=','ACTIVO')->value('id');

        $socio = new Socio($request->all());
        $mytime1 = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_nacimiento'));
        $socio->fecha_de_nacimiento = $mytime1->toDateString();
        $id_facultad = $request->get('id_facultad');
        if ($id_facultad==0) $socio->id_facultad=null;
        else $socio->id_facultad== $id_facultad;
        if($request->file('foto')){
            $file =$request->file('foto');
            $extension=$file->getClientOriginalName();//nombre de img
            $path=public_path().'/img/socios/';//donde guardamos img
            $file->move($path,$extension);//guardar imagen
            $socio->foto=$extension;
        }
		$socio->id_estado = $idEstado;
        if ( $socio->save())
        {
            return Redirect::to('socios');
        } 
        
    }
    public function index()
    {
        $socios=DB::table('socios as s')
        ->join('estados as e','s.id_estado','=','e.id')
        ->select('s.id','nombre_apellido','dni','email','telefono_celular','e.estado as estado','estado_documentacion')
        ->get();

        if(request()->ajax()) {
            return datatables()->of($socios)
            ->addColumn('action', 'socio.action_buton')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('socio.index');
    }

    
}
