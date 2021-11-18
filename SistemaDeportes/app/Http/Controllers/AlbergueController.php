<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Albergue;
use Yajra\Datatables\Datatables;

class AlbergueController extends Controller
{
    public function index(){
    	return view('Albergue.menu_albergue');
    }

    public function mostrar_albergues(){
    	$albergue=DB::table('albergue as a')
    					->select('a.id as id','a.nombre_albergue as nombre_albergue','a.cupo_total as cupo_total','a.cupo_disponible as cupo_disponible', 'a.estado_albergue as estado')
    					->get();

    	if(request()->ajax()){
            return datatables()->of($albergue)
            					->addColumn('action','Albergue.action_buton')
                    			->rawColumns(['action'])
                                ->make(true);
        }
    	return view('Albergue.mostrar_albergues'); 
    }
}
