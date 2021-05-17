<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArancelPorCategoriaRequest;

use App\TipoDeArancel;
use App\Categoria;
use App\ArancelPorCategoria;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\session;
use Carbon\Carbon;

class ImporteController extends Controller
{
    public function create(){
        $tipos=TipoDeArancel::all()->pluck('nombre','id')->ToArray();
        $categorias=Categoria::all()->pluck('categoria','id')->ToArray();
        return view("configuracion.importes.create")->with('tipos',$tipos)
                                                    ->with('categorias',$categorias);
                                    
	}

	public function store(ArancelPorCategoriaRequest $request){
       
        $idcategoria = $request->get('id_categoria');
        $idtipodearancel = $request->get('id_tipo_de_arancel');
        $fechaActual = Carbon::now();

        $arancel_por_categoria = new ArancelPorCategoria;
        $arancel_por_categoria->id_tipo_de_arancel = $idtipodearancel;
        $arancel_por_categoria->id_categoria = $idcategoria;
        $arancel_por_categoria->nro_resolucion = $request->get('nro_resolucion');
        $arancel_por_categoria->importe = $request->get('importe');
        $arancel_por_categoria->fecha_de_registro = $fechaActual;
       
        $arancel_anterior= ArancelPorCategoria::where("id_categoria", $idcategoria)
            ->where("id_tipo_de_arancel",$idtipodearancel)
            ->where("estado",'VIGENTE')->first();

        if ($arancel_por_categoria->save()){
            

            if(empty($arancel_anterior)){
                Session::flash('exito_registrar_importe','El importe se registró con éxito.');
                return Redirect::to('configuracion/importes/create');
            } else {
                $arancel_anterior->estado ="NO VIGENTE";
                $arancel_anterior->update();
                Session::flash('exito_registrar_importe','El importe se registró con éxito. El importe anterior quedó no vigente');
                return Redirect::to('configuracion/importes/create');
            }
            
        }
    }
}
