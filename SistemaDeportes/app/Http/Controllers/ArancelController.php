<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\User;
use App\Arancel;
use App\Ficha;
use DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ArancelController extends Controller
{
    public function store(Request $request,$idUser, $idFicha)
	{
       $validator = Validator::make($request->all(), [
            'importe'=>'required|numeric|between:0,9999.99',
        ]);

        if ($validator->fails()) {
            Session::flash('error_en_pago_arancel','No se registró el pago del arancel a la Ficha Nº '.$idFicha.' porque se ingresó un importe no válido.');
            return Redirect::back();         
        }

        $idCategoriaEstudiante=DB::table('categorias as c')->where('c.categoria','=','Estudiante')->value('id');
        $idCategoriaDocente=DB::table('categorias as c')->where('c.categoria','=','Docente')->value('id');
        $idCategoriaPAU=DB::table('categorias as c')->where('c.categoria','=','PAU')->value('id');
        $idCategoriaFamiliar=DB::table('categorias as c')->where('c.categoria','=','Familiar')->value('id');
        $fechaActual = Carbon::now();

        $ficha =Ficha::findOrFail($idFicha);
        $certificado = DB::table('certificado_medico as cm')
            ->join('estados_de_documento as e','e.id','=','cm.id_estado_documento')
            ->select('cm.id','e.estado as estadoCERT','cm.id_estado_documento as presentoCM')
            ->where('cm.id_ficha',$idFicha)
            ->first();
        if ($ficha->id_categoria ==$idCategoriaEstudiante){
            $car=DB::table('certificado_alumno_regular as car')
                ->join('estados_de_documento as e','e.id','=','car.id_estado_documento')
                ->select('car.id','e.estado as estadoCAR','car.id_estado_documento as presentoCAR')
                ->where('car.id_ficha',$idFicha)
                ->first();
            if (($certificado->estadoCERT === 'PRESENTO') && ($car->estadoCAR === 'PRESENTO')){
                $ficha->estado_documentacion = 'COMPLETA';
            }
        } elseif (($ficha->id_categoria == $idCategoriaDocente) or ($ficha->id_categoria == $idCategoriaPAU)){
            $recibo = DB::table('recibo_sueldo as r')
            ->join('estados_de_documento as e','e.id','=','r.id_estado_documento')
            ->select('r.id','e.estado as estadoREC','r.id_estado_documento as presentoR')
            ->where('r.id_ficha',$idFicha)
            ->first();

            if (($certificado->estadoCERT === 'PRESENTO') && ($recibo->estadoREC === 'PRESENTO')){
                $ficha->estado_documentacion = 'COMPLETA';
            }
        } else {
            $documentacion = DB::table('documentacion_familiar as df')
            ->join('estados_de_documento as e','e.id','=','df.id_estado_documento')
            ->select('df.id','e.estado as estadoDOC','df.id_estado_documento as presentoDF')
            ->where('df.id_ficha',$idFicha)
            ->first();
            if (($certificado->estadoCERT === 'PRESENTO') && ($documentacion->estadoDOC === 'PRESENTO')){
                $ficha->estado_documentacion = 'COMPLETA';
            }
        }

        $ficha->ultimo_arancel = $fechaActual->toDateString();
        $ficha->update();
        
        $arancel = new Arancel;
        $arancel->id_ficha = $idFicha;
        $arancel->id_user = $idUser;
        $arancel->fecha_de_pago = $fechaActual->toDateString();
        $arancel->fecha_de_vencimiento = $fechaActual->addDays(30)->toDateString();
        $arancel->importe = $request->get('importe');
        
        if ($arancel->save()){
            return Redirect::to('fichas/'.$ficha->id_usuario);
        }
    }
}
