<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SocioRequest;
use App\Socio;
use App\TipoSocio;

use DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

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
		
        if ( $socio->save())
        {
            return Redirect::to('inicio/');
        } 
        
    }
}
