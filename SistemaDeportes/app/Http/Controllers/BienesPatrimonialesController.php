<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;

use DB;

use App\Albergue;
use App\BienesPatrimoniales;
use App\BienesPorAlbergue;

use Carbon\Carbon;
use Yajra\Datatables\Datatables;


class BienesPatrimonialesController extends Controller
{
    public function index(){

        $bienespatrimoniales=DB::table('bienes_patrimoniales as b')
    					->select('id_bienpatrimonial as id','nombre_bienpatrimonial as nombre')
    					->get();

    	if(request()->ajax()){
            return datatables()->of($bienespatrimoniales)
            					->addColumn('action','bienes_patrimoniales.action_buton')
                    			->rawColumns(['action'])
                                ->make(true);
        }
    	return view('bienes_patrimoniales.index');
    }

    public function create(){
        $albergues=Albergue::all()->pluck('nombre_albergue','id')->ToArray();
    	return view('bienes_patrimoniales.create')->with('albergues',$albergues);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre_bienpatrimonial'=>'required|unique:bienes_patrimoniales',
        ]);

        if ($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json([
                'mensaje' => 'error',
                'error' => $error
            ]);      
        }

        DB::beginTransaction();
            $bienpatrimonial= new BienesPatrimoniales();
            $bienpatrimonial->nombre_bienpatrimonial = $request->get('nombre_bienpatrimonial');
            $bienpatrimonial->save();

            $albergues = $request->get('albergues');
            $cantidad = $request->get('cantidad');

            $id_bienpatrimonial=$bienpatrimonial->id_bienpatrimonial;
            $cont = 0;
            while ( $cont < count($albergues) ) {
                $bienporalbergue = new BienesPorAlbergue();
                $bienporalbergue->id_bienpatrimonial = $id_bienpatrimonial; //le asignamos el id del nuevo bien patrimonial
                $bienporalbergue->id_albergue = $albergues[$cont];
                $bienporalbergue->cantidad_total = $cantidad[$cont];
                $bienporalbergue->cantidad_disponible = $cantidad[$cont];
                $bienporalbergue->save();
                $cont = $cont+1;
            }
        
        DB::commit();

        return Redirect::to("bienespatrimoniales");
    }
}
