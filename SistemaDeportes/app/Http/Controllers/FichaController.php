<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioRequest;
use App\Usuario;
use App\Ficha;
use App\Estados;
use App\CertificadoAlumnoRegular;
use App\CertificadoMedico;
use App\DocumentacionFamiliar;
use App\ReciboSueldo;
use App\Categoria;
use App\UnidadAcademica;

use DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use DateTime;

class FichaController extends Controller
{
    public function create($idUsuario)
	{
        $usuario =Usuario::findOrFail($idUsuario);
        $categorias = DB::table('categorias as c')->get();
        $unidades=UnidadAcademica::all()->pluck('unidad','id')->ToArray();
        
        $anio = date("Y");
        $fecha=Carbon::createFromDate($anio,'03','31')->addYear();
        
        return view("ficha.create")->with('categorias',$categorias)
                                    ->with('unidades',$unidades)
                                    ->with('usuario',$usuario)
                                    ->with('fecha',$fecha);
                                    
	}

	public function store(Request $request, $idUsuario)
	{
        $idEstado=DB::table('estados as e')->where('e.estado','=','ACTIVO')->value('id');
        $idEstadoPresento = DB::table('estados_de_documento as e')->where('e.estado','=','PRESENTO')->value('id');
        $idEstadoNoPresento = DB::table('estados_de_documento as e')->where('e.estado','=','NO PRESENTO')->value('id');
        $usuario =Usuario::findOrFail($idUsuario);
        $fechaActual = Carbon::now();

        $idcategoria = $request->get('id_categoria');
        $categoria = $request->get('categoria');
        $nombreCategoria = DB::table('categorias as c')->where('c.id','=',$categoria)->value('categoria');
        $ficha = new Ficha;
        $ficha->id_usuario = $idUsuario;
        $ficha->id_categoria = $categoria;
        $ficha->id_estado = $idEstado;

        if ($categoria == 1){
            $this->validate($request,[
                'id_unidad_academica'=>'required',
                'lu'=>'required',
            ]);
            
            $ficha->lu_legajo = $request->get('lu');
            $ficha->id_unidad_academica = $request->get('id_unidad_academica');

            $presento_cert_alum = $request->get('certificado_alumno');
            $presento_cert_med = $request->get('certificado_estudiante');

            if (($presento_cert_alum==1) and ($presento_cert_med==1)) $ficha->estado_documentacion = 'COMPLETA';
            else $ficha->estado_documentacion = 'INCOMPLETA';

            if ($ficha->save()){
               
                $usuario->categoria = $nombreCategoria;
                $usuario->update();

                if ($presento_cert_alum==1){
                    $car = new CertificadoAlumnoRegular;
                    $car ->id_ficha = $ficha->id;
                    $car ->id_estado_documento = $idEstadoPresento;
                    $car ->fecha_de_presentacion = $fechaActual->toDateString();
                    $car ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_vencimiento'))->toDateString();
                    $car->save();
                }
                if ($presento_cert_med==1){
                    $cert = new CertificadoMedico;
                    $cert ->id_ficha = $ficha->id;
                    $cert ->id_estado_documento = $idEstadoPresento;
                    $cert ->fecha_de_emision = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_estudiante'))->toDateString();
                    $cert ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_estudiante'))->addYear()->toDateString();
                    $cert ->nombre_medico = $request->get('certificado_medico_estudiante');
                    $cert->save();
                }
                return Redirect::to('usuarios');
            };
        } elseif (($categoria == 2) or ($categoria == 3)) {
            $presento_recibo_sueldo = $request->get('recibo_sueldo');
            $presento_cert_med = $request->get('certificado_profesional');

            if ($presento_recibo_sueldo==1 and $presento_cert_med==1){
                $this->validate($request,[
                    'lugar_de_trabajo'=>'required',
                    'legajo'=>'required',
                    'nro_recibo'=>'required',
                    'fecha_de_emision_certificado_profesional'=>'required',
                ]);
                
                $ficha->estado_documentacion = 'COMPLETA';
                
            } elseif ($presento_recibo_sueldo==1 and $presento_cert_med==0){
                $this->validate($request,[
                    'lugar_de_trabajo'=>'required',
                    'legajo'=>'required',
                    'nro_recibo'=>'required',
                ]);
                
                $ficha->estado_documentacion = 'INCOMPLETA';
            } elseif ($presento_recibo_sueldo==0 and $presento_cert_med==1){
                $this->validate($request,[
                    'lugar_de_trabajo'=>'required',
                    'legajo'=>'required',
                    'fecha_de_emision_certificado_profesional'=>'required',
                ]);
                $ficha->estado_documentacion = 'INCOMPLETA';
            } else {
                $this->validate($request,[
                    'lugar_de_trabajo'=>'required',
                    'legajo'=>'required',
                ]);
                $ficha->estado_documentacion = 'INCOMPLETA';
            }
            if ($ficha->save()){
                $usuario->categoria= $nombreCategoria;
                $usuario->update();
                if ($presento_recibo_sueldo==1){
                    $recibo = new ReciboSueldo;
                    $recibo ->id_ficha = $ficha->id;
                    $recibo ->nro_recibo = $request->get('nro_recibo');
                    $recibo ->id_estado_documento = $idEstadoPresento;
                    $recibo ->fecha_de_presentacion = $fechaActual->toDateString();
                    $recibo->save();
                }
                if ($presento_cert_med==1){
                    $cert = new CertificadoMedico;
                    $cert ->id_ficha = $ficha->id;
                    $cert ->id_estado_documento = $idEstadoPresento;
                    $cert ->fecha_de_emision = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_profesional'))->toDateString();
                    $cert ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_estudiante'))->addYear()->toDateString();
                    $cert ->nombre_medico = $request->get('certificado_medico_profesional');
                    $cert->save();
                }
                return Redirect::to('usuarios');
            }
            
        } else {
            if ($categoria == 4){
            
                $cert_med = $request->get('certificado_familiar');
                $documentacion = $request->get('documentacion_probatoria');
                if($cert_med==1 and $documentacion==1){
                    $this->validate($request,[
                        'nombre_familiar'=>'required',
                        'legajo_familiar'=>'required',
                        'nombre_documentacion'=>'required',
                        'fecha_de_emision_certificado_familiar'=>'required',
                      ]);
                      $ficha->estado_documentacion = 'COMPLETA';

                } elseif ($cert_med==1 and $documentacion==0){
                    $this->validate($request,[
                        /* 'nombre_familiar'=>'required',
                        'legajo_familiar'=>'required', */
                        'fecha_de_emision_certificado_familiar'=>'required',
                      ]);
                    
                    $ficha->estado_documentacion = 'INCOMPLETA';
                } elseif ($cert_med==0 and $documentacion==1){
                    $this->validate($request,[
                        'nombre_familiar'=>'required',
                        'legajo_familiar'=>'required',
                        'nombre_documentacion'=>'required',
                      ]);

                    $ficha->estado_documentacion = 'INCOMPLETA';
                } else {
                    /* $this->validate($request,[
                        'nombre_familiar'=>'required',
                        'legajo_familiar'=>'required',
                      ]); */
                    
                    $ficha->estado_documentacion = 'INCOMPLETA';
                }
                
                if ($ficha->save()){
                    $usuario->categoria= $nombreCategoria;
                    $usuario->update();
                    if ($documentacion==1){
                        $doc = new DocumentacionFamiliar;
                        $doc ->id_ficha = $ficha->id;
                        $doc ->nombre_documentacion = $request->get('nombre_documentacion');
                        $doc ->id_estado_documento = $idEstadoPresento;
                        $doc ->fecha_de_presentacion = $fechaActual->toDateString();
                        $doc ->nombre_familiar = $request->get('nombre_familiar');
                        $doc ->legajo_familiar = $request->get('legajo_familiar');
                        $doc->save();
                    }
                    if ($cert_med==1){
                        $cert = new CertificadoMedico;
                        $cert ->id_ficha = $ficha->id;
                        $cert ->id_estado_documento = $idEstadoPresento;
                        $cert ->fecha_de_emision = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_familiar'))->toDateString();
                        $cert ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_estudiante'))->addYear()->toDateString();
                        $cert ->nombre_medico = $request->get('certificado_medico_familiar');
                        $cert->save();
                    }
                    return Redirect::to('usuarios');
                }
            
            }
        }
        
    }
}
