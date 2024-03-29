<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\User;
use App\Arancel;
use App\Ficha;
use App\ArancelPorCategoria;
use App\CertificadoAlumnoRegular;
use App\CertificadoMedico;
use App\DocumentacionFamiliar;
use App\ReciboSueldo;

use DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class ArancelController extends Controller
{
    public function store(Request $request,$idUser, $idFicha)
	{
       $validator = Validator::make($request->all(), [
            'importe'=>'required|numeric|between:0,9999.99',
            'cantidad_meses'=>'required|numeric',
            'nro_recibo'=>'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error_en_pago_arancel','No se registró el pago del arancel a la Ficha Nº '.$idFicha.' porque no se completaron todos campos obligatorios.');
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

        
        
        $arancel = new Arancel;
        $arancel->id_ficha = $idFicha;
        $arancel->id_user = $idUser;
        $arancel->fecha_de_pago = Carbon::now()->toDateString();
        $arancel->importe = $request->get('importe');
        $arancel->fecha_de_inicio = $request->get('fecha_de_inicio');
        $arancel->fecha_de_vencimiento = $request->get('fecha_de_vencimiento');
        $arancel->cantidad_meses = $request->get('cantidad_meses');
        $arancel->nro_recibo = $request->get('nro_recibo');

        if ($arancel->save()){
            $ficha->ultimo_arancel = $request->get('fecha_de_vencimiento');
            $ficha->update();
            return Redirect::to('fichas/'.$ficha->id_usuario);
        }
    }

    public function index(){
        $aranceles = DB::table('aranceles as a')
        ->join('fichas as f','a.id_ficha','=','f.id')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->select('a.id','id_ficha','a.id_user',DB::raw('CONCAT("$",importe)AS importe'),DB::raw("DATE_FORMAT(fecha_de_pago,'%d/%m/%Y') as fecha_de_pago"),DB::raw("DATE_FORMAT(fecha_de_vencimiento,'%d/%m/%Y') as fecha_de_vencimiento"),'u.dni')
        ->get();

        if(request()->ajax()) {
            return datatables()->of($aranceles)
            ->rawColumns(['action'])
            ->make(true);
        };

        return view("arancel.index");
        
    }

    public function buscarNroCarnet($nro){
        
        $ficha = DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->join('categorias as c','f.id_categoria','=','c.id')
        ->join('estados as e','f.id_estado','=','e.id')
        ->select('f.id as idficha','f.fecha as fecha','f.lu_legajo','f.lugar_de_trabajo','f.ultimo_arancel','f.id_usuario as idusuario','f.id_unidad_academica',
                    'e.estado as estado','c.categoria as categoria','f.id_categoria',
                    DB::raw('CONCAT(u.apellido," ",u.nombre)AS nombre_usuario'), 'u.dni', 'u.fecha_de_nacimiento', 'u.email','u.domicilio','u.foto')
        ->where('f.id',$nro)
        ->first();
        $idEstadoNoPresento = DB::table('estados_de_documento as e')->where('e.estado','=','NO PRESENTO')->value('id');
        $idTipoDeArancel= DB::table('tipo_de_arancel as t')->where('t.nombre','=','SALA DE MUSCULACION')->value('id');
        $fecha= Carbon::now()->format('Y-m-d');
        $mensaje = "";

        if ($ficha!=null) {
            $arancel_por_categoria = ArancelPorCategoria::where("id_categoria", $ficha->id_categoria)
                ->where("id_tipo_de_arancel",$idTipoDeArancel)
                ->where("estado",'VIGENTE')->first();
            
            if ($arancel_por_categoria!=null){
                $importe = $arancel_por_categoria->importe;
                if ($ficha->estado == 'ACTIVO') {
                    $nroValido=true;
                    // * CERTIFICADO MÉDICO *
                    $certmedico=CertificadoMedico::where('id_ficha',$ficha->idficha)->first();
                    if( $certmedico->id_estado_documento == $idEstadoNoPresento ){
                        $mensaje= "NO PRESENTÓ CERTIFICADO MÉDICO.";
                    } else {
                        if ($certmedico->fecha_de_vencimiento < $fecha) {
                            $mensaje="EL CERTIFICADO MÉDICO VENCIÓ EL ".$certmedico->fecha_de_vencimiento->format('d/m/Y').".";
                        }
                    }

                    if ($ficha->categoria=='Estudiante'){
                        // * CERTIFICADO DE ALUMNO REGULAR *
                        $car=CertificadoAlumnoRegular::where('id_ficha',$ficha->idficha)->first();
                        if($car->id_estado_documento == $idEstadoNoPresento){
                            $mensaje= $mensaje."NO PRESENTÓ CERTIFICADO DE ALUMNO REGULAR.";
                            
                        } else {
                            if ($car->fecha_de_vencimiento < $fecha) {
                                $mensaje = $mensaje."EL CERTIFICADO DE ALUMNO REGULAR VENCIÓ EL ".$car->fecha_de_vencimiento->format('d/m/Y').".";
                            }
                        }
                    } elseif ($ficha->categoria=='Docente' || $ficha->categoria=='PAU') {
                        // * CONSTANCIA DE TRABAJO PAU - DOCENTE (recibo de sueldo) *
                        $recibo=ReciboSueldo::where('id_ficha',$ficha->idficha)->first();
                        if($recibo->id_estado_documento == $idEstadoNoPresento){
                            $mensaje= $mensaje."NO PRESENTÓ CONSTANCIA DE TRABAJO.";
                        }
                        
                    } else {
                        if ($ficha->categoria == 'Familiar'){
                            // * DOCUMENTACIÓN FAMILIAR *
                            $doc=DocumentacionFamiliar::where('id_ficha',$ficha->idficha)->first();
                            if($doc->id_estado_documento == $idEstadoNoPresento){
                                $mensaje= $mensaje."NO PRESENTÓ DOCUMENTACIÓN FAMILIAR.";
                            }
                        }
                    }

                    if ($ficha->ultimo_arancel!=null){
                        $fechaUltimoArancel = Carbon::parse($ficha->ultimo_arancel);
                        $fecha_actual = Carbon::now();
                        if($fechaUltimoArancel->gt($fecha_actual)){
                            $mensaje = $mensaje.'El último pago de arancel sigue vigente, vence el '.Carbon::parse($ficha->ultimo_arancel)->format('d/m/Y').'.';
                        } else $mensaje = $mensaje.'El último pago de arancel  venció el '.Carbon::parse($ficha->ultimo_arancel)->format('d/m/Y').'.'; 
                    }  else $mensaje = $mensaje.'Aún no se ha realizó ningún registro de arancel al Carnet Nº '.$nro.'.';
                    
                } else {
                    $nroValido=false;
                    $importe="0";
                    Session::flash('error_en_pago_arancel','El carnet Nº '.$nro.' no se encuentra ACTIVO.');       
                }
            } else {
                $nroValido=false;
                $importe="0";
                Session::flash('error_en_pago_arancel','Comuníquese con un administrador porque no se realizó el registro de importe para la categoria '.$ficha->categoria.' en Gestión de Importes. ');
            }
            
        } else {
            $nroValido=false;
            $importe="0";
            Session::flash('error_en_pago_arancel','No se encontró el carnet Nº '.$nro.' por favor vuelva a ingresar un número.');       
        }

        return response()->json([
            'nroValido' => $nroValido,
            'ficha' => $ficha,
            'importe' => $importe,
            'mensaje' => $mensaje
        ]);
    }

    public function registrarArancelDesdeModulo(Request $request,$idFicha){
       $validator = Validator::make($request->all(), [
            'importe'=>'required|numeric|between:0,9999.99',
            'cantidad_meses'=>'required|numeric',
            'nro_recibo'=>'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error_en_pago_arancel','No se registró el pago del arancel a la Ficha Nº '.$idFicha.' porque no se completaron todos campos obligatorios.');       
            return response()->json([
                'mensaje' => 'importe no valido'
            ]);
        } else {
            $idCategoriaEstudiante=DB::table('categorias as c')->where('c.categoria','=','Estudiante')->value('id');
            $idCategoriaDocente=DB::table('categorias as c')->where('c.categoria','=','Docente')->value('id');
            $idCategoriaPAU=DB::table('categorias as c')->where('c.categoria','=','PAU')->value('id');
            $idCategoriaFamiliar=DB::table('categorias as c')->where('c.categoria','=','Familiar')->value('id');
    
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
    
            $arancel = new Arancel;
            $arancel->id_ficha = $idFicha;
            $arancel->id_user = auth()->user()->id;
            $arancel->fecha_de_pago = Carbon::now()->toDateString();
            $arancel->fecha_de_inicio = $request->get('fecha_de_inicio');
            $arancel->fecha_de_vencimiento = $request->get('fecha_de_vencimiento');
            $arancel->importe = $request->get('importe');
            $arancel->cantidad_meses = $request->get('cantidad_meses');
            $arancel->nro_recibo = $request->get('nro_recibo');
            
            if ($arancel->save()){
                $ficha->ultimo_arancel = $request->get('fecha_de_vencimiento');
                $ficha->update();
                Session::flash('exito_en_pago_arancel','Se registró el pago del arancel a la Ficha Nº '.$idFicha.'.');
                return response()->json([
                    'mensaje' => 'éxito al registrar arancel'
                ]);
            }
        }

        
    }
}
