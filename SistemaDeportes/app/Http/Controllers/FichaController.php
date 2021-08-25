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
use App\ArancelPorCategoria;

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
        $categorias = DB::table('categorias as c')->where('c.tipo','=','SALA DE MUSCULACIÓN')->get();
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
        $idCategoriaEstudiante=DB::table('categorias as c')->where('c.categoria','=','Estudiante')->value('id');
        $idCategoriaDocente=DB::table('categorias as c')->where('c.categoria','=','Docente')->value('id');
        $idCategoriaPAU=DB::table('categorias as c')->where('c.categoria','=','PAU')->value('id');
        $idCategoriaFamiliar=DB::table('categorias as c')->where('c.categoria','=','Familiar')->value('id');

        $ficha = new Ficha;
        $ficha->id_usuario = $idUsuario;
        $ficha->id_categoria = $categoria;
        $ficha->id_estado = $idEstado;
        $ficha->fecha = $fechaActual->toDateString();
        if ($categoria == $idCategoriaEstudiante){
            $this->validate($request,[
                'id_unidad_academica'=>'required',
                'lu'=>'required',
            ]);
            
            $ficha->lu_legajo = $request->get('lu');
            $ficha->id_unidad_academica = $request->get('id_unidad_academica');

            $presento_cert_alum = $request->get('certificado_alumno');
            $presento_cert_med = $request->get('certificado_estudiante');

            if ($ficha->save()){
               
                $usuario->categoria = $nombreCategoria;
                $usuario->update();

                $car = new CertificadoAlumnoRegular;
                $car ->id_ficha = $ficha->id;
                if ($presento_cert_alum==1){
                    $car ->id_estado_documento = $idEstadoPresento;
                    $car ->fecha_de_presentacion = $fechaActual->toDateString();
                    $car ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_vencimiento'))->toDateString(); 
                } else $car ->id_estado_documento = $idEstadoNoPresento;
                $car->save();

                $cert = new CertificadoMedico;
                $cert ->id_ficha = $ficha->id;
                if ($presento_cert_med==1){
                    $cert ->id_estado_documento = $idEstadoPresento;
                    $cert ->fecha_de_emision = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_estudiante'))->toDateString();
                    $cert ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_estudiante'))->addYear()->toDateString();
                    $cert ->nombre_medico = $request->get('certificado_medico_estudiante');
                } else  $cert ->id_estado_documento = $idEstadoNoPresento;
                $cert->save();
                return Redirect::to('fichas/'.$idUsuario);
            };
        } elseif (($categoria == $idCategoriaDocente) or ($categoria == $idCategoriaPAU)) {
            $ficha->lu_legajo = $request->get('legajo');
            $ficha->lugar_de_trabajo = $request->get('lugar_de_trabajo');
            
            $presento_recibo_sueldo = $request->get('recibo_sueldo');
            $presento_cert_med = $request->get('certificado_profesional');

            if ($presento_recibo_sueldo==1 and $presento_cert_med==1){
                $this->validate($request,[
                    'lugar_de_trabajo'=>'required',
                    'legajo'=>'required',
                    'fecha_de_emision_certificado_profesional'=>'required',
                ]);
                
                // $ficha->estado_documentacion = 'COMPLETA';
                
            } elseif ($presento_recibo_sueldo==1 and $presento_cert_med==0){
                $this->validate($request,[
                    'lugar_de_trabajo'=>'required',
                    'legajo'=>'required',
                ]);
                
                /* $ficha->estado_documentacion = 'INCOMPLETA'; */
            } elseif ($presento_recibo_sueldo==0 and $presento_cert_med==1){
                $this->validate($request,[
                    'lugar_de_trabajo'=>'required',
                    'legajo'=>'required',
                    'fecha_de_emision_certificado_profesional'=>'required',
                ]);
                // $ficha->estado_documentacion = 'INCOMPLETA';
            } else {
                $this->validate($request,[
                    'lugar_de_trabajo'=>'required',
                    'legajo'=>'required',
                ]);
                // $ficha->estado_documentacion = 'INCOMPLETA';
            }
            if ($ficha->save()){
                $usuario->categoria= $nombreCategoria;
                $usuario->update();

                $recibo = new ReciboSueldo;
                $recibo ->id_ficha = $ficha->id;
                if ($presento_recibo_sueldo==1){
                    $recibo ->nro_recibo = $request->get('nro_recibo');
                    $recibo ->id_estado_documento = $idEstadoPresento;
                    $recibo ->fecha_de_presentacion = $fechaActual->toDateString();
                } else $recibo ->id_estado_documento = $idEstadoNoPresento;
                $recibo->save();

                $cert = new CertificadoMedico;
                $cert ->id_ficha = $ficha->id;
                if ($presento_cert_med==1){
                    $cert ->id_estado_documento = $idEstadoPresento;
                    $cert ->fecha_de_emision = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_profesional'))->toDateString();
                    $cert ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_profesional'))->addYear()->toDateString();
                    $cert ->nombre_medico = $request->get('certificado_medico_profesional');
                } else $cert ->id_estado_documento = $idEstadoNoPresento;
                $cert->save();

                return Redirect::to('fichas/'.$idUsuario);
            }
            
        } else {
            if ($categoria == $idCategoriaFamiliar){
            
                $cert_med = $request->get('certificado_familiar');
                $documentacion = $request->get('documentacion_probatoria');
                if($cert_med==1 and $documentacion==1){
                    $this->validate($request,[
                        'nombre_familiar'=>'required',
                        'legajo_familiar'=>'required',
                        'nombre_documentacion'=>'required',
                        'fecha_de_emision_certificado_familiar'=>'required',
                      ]);
                      //$ficha->estado_documentacion = 'COMPLETA';

                } elseif ($cert_med==1 and $documentacion==0){
                    $this->validate($request,[
                        /* 'nombre_familiar'=>'required',
                        'legajo_familiar'=>'required', */
                        'fecha_de_emision_certificado_familiar'=>'required',
                      ]);
                    
                    //$ficha->estado_documentacion = 'INCOMPLETA';
                } elseif ($cert_med==0 and $documentacion==1){
                    $this->validate($request,[
                        'nombre_familiar'=>'required',
                        'legajo_familiar'=>'required',
                        'nombre_documentacion'=>'required',
                      ]);

                    //$ficha->estado_documentacion = 'INCOMPLETA';
                } else { 
                    //$ficha->estado_documentacion = 'INCOMPLETA';
                }
                
                if ($ficha->save()){
                    $usuario->categoria= $nombreCategoria;
                    $usuario->update();

                    $doc = new DocumentacionFamiliar;
                    $doc ->id_ficha = $ficha->id;
                    if ($documentacion==1){
                        $doc ->nombre_documentacion = $request->get('nombre_documentacion');
                        $doc ->id_estado_documento = $idEstadoPresento;
                        $doc ->fecha_de_presentacion = $fechaActual->toDateString();
                        $doc ->nombre_familiar = $request->get('nombre_familiar');
                        $doc ->legajo_familiar = $request->get('legajo_familiar');
                    } else $doc ->id_estado_documento = $idEstadoNoPresento;
                    $doc->save();

                    $cert = new CertificadoMedico;
                    $cert ->id_ficha = $ficha->id;
                    if ($cert_med==1){
                        $cert ->id_estado_documento = $idEstadoPresento;
                        $cert ->fecha_de_emision = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_familiar'))->toDateString();
                        $cert ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_familiar'))->addYear()->toDateString();
                        $cert ->nombre_medico = $request->get('certificado_medico_familiar');
                    }else $cert ->id_estado_documento = $idEstadoNoPresento;
                    $cert->save();

                    return Redirect::to('fichas/'.$idUsuario);
                }
            
            }
        }
        
    }

    public function mostrarFichasDeUsuario($id){
        $usuario =Usuario::findOrFail($id);
        $fichas = DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->join('categorias as c','f.id_categoria','=','c.id')
        ->join('estados as e','f.id_estado','=','e.id')
        ->select('f.id','f.fecha as fecha','e.estado as estado','c.categoria as categoria','f.estado_documentacion as documentacion')
        ->where('f.id_usuario',$id)
        ->orderBy('f.id','desc')
        ->get();

        return view('ficha.mostrarFichas')->with('usuario',$usuario)->with('fichas',$fichas);
    }

    public function editFichaEstudiante($idFicha){
        $ficha = Ficha::findOrFail($idFicha);
        $usuario =Usuario::findOrFail($ficha->id_usuario);
        $unidad = UnidadAcademica::where('id', '=' ,$ficha->id_unidad_academica)->firstOrFail();
        $anio = date("Y");
        $fecha=Carbon::createFromDate($anio,'03','31')->addYear();

        $car=DB::table('certificado_alumno_regular as car')
        ->join('estados_de_documento as e','e.id','=','car.id_estado_documento')
        ->select('car.id','fecha_de_vencimiento','car.id_estado_documento as presentoCAR')
        ->where('car.id_ficha',$idFicha)
        ->first();
        $certificado = DB::table('certificado_medico as cm')
        ->join('estados_de_documento as e','e.id','=','cm.id_estado_documento')
        ->select('cm.id','fecha_de_emision','nombre_medico','cm.id_estado_documento as presentoCM')
        ->where('cm.id_ficha',$idFicha)
        ->first();
        return view('ficha.edit.editFichaEstudiante')->with('usuario',$usuario)
                                                    ->with('ficha',$ficha)
                                                    ->with('unidad',$unidad)
                                                    ->with('certificado',$certificado)
                                                    ->with('car',$car)
                                                    ->with('fecha',$fecha);
    }

    public function editFichaProfesional($idFicha){
        $ficha = Ficha::findOrFail($idFicha);
        $usuario =Usuario::findOrFail($ficha->id_usuario);

        $recibo = DB::table('recibo_sueldo as r')
        ->join('estados_de_documento as e','e.id','=','r.id_estado_documento')
        ->select('r.id','nro_recibo','r.id_estado_documento as presentoR')
        ->where('r.id_ficha',$idFicha)
        ->first();

        $certificado = DB::table('certificado_medico as cm')
        ->join('estados_de_documento as e','e.id','=','cm.id_estado_documento')
        ->select('cm.id','fecha_de_emision','nombre_medico','cm.id_estado_documento as presentoCM')
        ->where('cm.id_ficha',$idFicha)
        ->first();
        return view('ficha.edit.editFichaProfesional')->with('usuario',$usuario)
                                                    ->with('ficha',$ficha)
                                                    ->with('recibo',$recibo)
                                                    ->with('certificado',$certificado);
    }

    public function editFichaFamiliar($idFicha){

        $ficha = Ficha::findOrFail($idFicha);

        $documentacion = DB::table('documentacion_familiar as df')
        ->join('estados_de_documento as e','e.id','=','df.id_estado_documento')
        ->select('df.id','nombre_documentacion','nombre_familiar','legajo_familiar','df.id_estado_documento as presentoDF')
        ->where('df.id_ficha',$idFicha)
        ->first();

        $certificado = DB::table('certificado_medico as cm')
        ->join('estados_de_documento as e','e.id','=','cm.id_estado_documento')
        ->select('cm.id','fecha_de_emision','nombre_medico','cm.id_estado_documento as presentoCM')
        ->where('cm.id_ficha',$idFicha)
        ->first();

        $usuario =Usuario::findOrFail($ficha->id_usuario);

        return view('ficha.edit.editFichaFamiliar')->with('usuario',$usuario)
                                                ->with('ficha',$ficha)
                                                ->with('documentacion',$documentacion)
                                                ->with('certificado',$certificado);
    }

    public function updateFichaProfesional(Request $request,$idFicha){
        $ficha = Ficha::findOrFail($idFicha);
        $fechaActual = Carbon::now();
        $idEstadoPresento = DB::table('estados_de_documento as e')->where('e.estado','=','PRESENTO')->value('id');
        $idEstadoNoPresento = DB::table('estados_de_documento as e')->where('e.estado','=','NO PRESENTO')->value('id');
        
        $recibo = ReciboSueldo::where('id_ficha', '=' ,$idFicha)->firstOrFail();
        $certificado = CertificadoMedico::where('id_ficha', '=' ,$idFicha)->firstOrFail();

        $presento_recibo_sueldo = $request->get('recibo_sueldo');
        $presento_cert_med = $request->get('certificado_profesional');

        $this->validate($request,[
            'lugar_de_trabajo'=>'required',
        ]);
        $ficha->lugar_de_trabajo=$request->get('lugar_de_trabajo');
        $ficha->update();
        
        if ($presento_recibo_sueldo==1){
            $recibo ->nro_recibo = $request->get('nro_recibo');
            $recibo ->id_estado_documento = $idEstadoPresento;
            $recibo ->fecha_de_presentacion = $fechaActual->toDateString();
            $recibo->update();
        }
        if ($presento_cert_med==1){
            $certificado ->id_estado_documento = $idEstadoPresento;
            $certificado ->fecha_de_emision = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_profesional'))->toDateString();
            $certificado ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_profesional'))->addYear()->toDateString();
            $certificado ->nombre_medico = $request->get('certificado_medico_profesional');
            $certificado->update();
        }
        if (($certificado->id_estado_documento == $idEstadoPresento) && ($presento_cert_med==0)){
            $presento_cert_med = 1;
        }
        if (( $recibo->id_estado_documento== $idEstadoPresento) && ($presento_recibo_sueldo==0)){
            $presento_recibo_sueldo = 1;
        }
        // SI SE REGISTRO UN ARANCEL A LA FICHA
        if ($ficha->ultimo_arancel!=null){
            $fechaUltimoArancel = Carbon::parse($ficha->ultimo_arancel);
            //SI FECHA DE ULTIMO ARANCEL ES MAYOR QUE FECHA ACTUAL Y PRESENTO RECIBO DE SUELDO Y PRESENTO CERTIFICADO MEDICO
            if(($fechaUltimoArancel->gt($fechaActual)) && $presento_recibo_sueldo && $presento_cert_med){
                $ficha->estado_documentacion = 'COMPLETA';
                $ficha->update();
            }
        }
        return Redirect::to('fichas/'.$ficha->id_usuario);
    }
    public function updateFichaFamiliar(Request $request,$idFicha){
        $presento_cert_med = $request->get('certificado_familiar');
        $presento_documentacion = $request->get('documentacion_probatoria');
        if($presento_documentacion==1){
            $this->validate($request,[
                'nombre_familiar'=>'required',
                'legajo_familiar'=>'required',
                'nombre_documentacion'=>'required',
              ]);
        } 
        
        $ficha = Ficha::findOrFail($idFicha);
        $fechaActual = Carbon::now();
        $idEstadoPresento = DB::table('estados_de_documento as e')->where('e.estado','=','PRESENTO')->value('id');
        $idEstadoNoPresento = DB::table('estados_de_documento as e')->where('e.estado','=','NO PRESENTO')->value('id');
        
        $documentacion = DocumentacionFamiliar::where('id_ficha', '=' ,$idFicha)->firstOrFail();
        $certificado = CertificadoMedico::where('id_ficha', '=' ,$idFicha)->firstOrFail();

        if ($presento_documentacion==1){
            $documentacion ->nombre_documentacion = $request->get('nombre_documentacion');
            $documentacion ->fecha_de_presentacion = $fechaActual->toDateString();
            $documentacion ->nombre_familiar = $request->get('nombre_familiar');
            $documentacion ->legajo_familiar = $request->get('legajo_familiar');
            $documentacion ->id_estado_documento = $idEstadoPresento;
            $documentacion->update();
        }
        if ($presento_cert_med==1){
            $certificado ->id_estado_documento = $idEstadoPresento;
            $certificado ->fecha_de_emision = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_familiar'))->toDateString();
            $certificado ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_familiar'))->addYear()->toDateString();
            $certificado ->nombre_medico = $request->get('certificado_medico_familiar');
            $certificado->update();
        }
        if (($certificado->id_estado_documento == $idEstadoPresento) && ($presento_cert_med==0)){
            $presento_cert_med = 1;
        }
        if (($documentacion->id_estado_documento== $idEstadoPresento) && ($presento_documentacion==0)){
            $presento_documentacion = 1;
        }
        // SI SE REGISTRO UN ARANCEL A LA FICHA
        if ($ficha->ultimo_arancel!=null){
            $fechaUltimoArancel = Carbon::parse($ficha->ultimo_arancel) ;
            //SI FECHA DE ULTIMO ARANCEL ES MAYOR QUE FECHA ACTUAL Y PRESENTO DOCUMENTACION FAMILIAR Y PRESENTO CERTIFICADO MEDICO
            if(($fechaUltimoArancel->gt($fechaActual)) && $presento_documentacion && $presento_cert_med){
                $ficha->estado_documentacion = 'COMPLETA';
                $ficha->update();
            }
        }
        return Redirect::to('fichas/'.$ficha->id_usuario);
    }

    public function updateFichaEstudiante(Request $request,$idFicha){
        $ficha = Ficha::findOrFail($idFicha);
        $fechaActual = Carbon::now();
        $idEstadoPresento = DB::table('estados_de_documento as e')->where('e.estado','=','PRESENTO')->value('id');
        $idEstadoNoPresento = DB::table('estados_de_documento as e')->where('e.estado','=','NO PRESENTO')->value('id');
        
        $certificado_alumno = CertificadoAlumnoRegular::where('id_ficha', '=' ,$idFicha)->firstOrFail();
        $certificado_medico = CertificadoMedico::where('id_ficha', '=' ,$idFicha)->firstOrFail();

        $presento_cert_alum = $request->get('certificado_alumno');
        $presento_cert_med = $request->get('certificado_estudiante');

        if ($presento_cert_alum==1){
            $certificado_alumno->id_estado_documento = $idEstadoPresento;
            $certificado_alumno->fecha_de_presentacion = $fechaActual->toDateString();
            $certificado_alumno->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_vencimiento'))->toDateString();     
            $certificado_alumno->update();
        }
        if ($presento_cert_med==1){
            $certificado_medico ->id_estado_documento = $idEstadoPresento;
            $certificado_medico ->fecha_de_emision = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_estudiante'))->toDateString();
            $certificado_medico ->fecha_de_vencimiento = Carbon::createFromFormat('Y-m-d',$request->get('fecha_de_emision_certificado_estudiante'))->addYear()->toDateString();
            $certificado_medico ->nombre_medico = $request->get('certificado_medico_estudiante');
            $certificado_medico->update();
        }
        if (($certificado_medico ->id_estado_documento == $idEstadoPresento) && ($presento_cert_med==0)){
            $presento_cert_med = 1;
        }
        if (($certificado_alumno->id_estado_documento== $idEstadoPresento) && ($presento_cert_alum==0)){
            $presento_cert_alum = 1;
        }
        // SI SE REGISTRO UN ARANCEL A LA FICHA
        if ($ficha->ultimo_arancel!=null){
            $fechaUltimoArancel = Carbon::parse($ficha->ultimo_arancel) ;
            //SI FECHA DE ULTIMO ARANCEL ES MAYOR QUE FECHA ACTUAL Y PRESENTO CERTIFICADO MEDICO Y PRESENTO CERT DE ALUMNO REGULAR
            if(($fechaUltimoArancel->gt($fechaActual)) && $presento_cert_med && $presento_cert_alum){
                $ficha->estado_documentacion = 'COMPLETA';
                $ficha->update();
            }
        }
        return Redirect::to('fichas/'.$ficha->id_usuario);

    }

    public function show($id){
        
        $ficha = DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->join('categorias as c','f.id_categoria','=','c.id')
        ->join('estados as e','f.id_estado','=','e.id')
        ->select('f.id as idficha','f.fecha as fecha','f.lu_legajo','f.lugar_de_trabajo','f.ultimo_arancel','f.id_usuario as idusuario','f.id_unidad_academica',
                    'e.estado as estado','c.categoria as categoria',
                    DB::raw('CONCAT(u.apellido," ",u.nombre)AS nombre_usuario'), 'u.dni', 'u.fecha_de_nacimiento', 'u.email','u.domicilio','u.foto')
        ->where('f.id',$id)
        ->first();

        if ($ficha->id_unidad_academica != null){
            $unidad =  DB::table('unidades_academicas as ua')->where('ua.id','=',$ficha->id_unidad_academica)->value('unidad');
        } else $unidad = "";

        if ($ficha->categoria == 'Estudiante'){
            $certificado_alumno = CertificadoAlumnoRegular::where('id_ficha', '=' ,$id)->firstOrFail();
            if ($certificado_alumno->fecha_de_vencimiento != null ) $vencimiento_certificado_alumno =  Carbon::parse($certificado_alumno->fecha_de_vencimiento)->format('d/m/Y');
            else $vencimiento_certificado_alumno =  $vencimiento_certificado_alumno = "NO PRESENTO";
        } else $vencimiento_certificado_alumno = "";

        if ($ficha->ultimo_arancel != null){
            $vencimiento_ultimo_arancel =  Carbon::parse($ficha->ultimo_arancel)->format('d/m/Y');
        } else $vencimiento_ultimo_arancel = "NO REGISTRA PAGOS DE ARANCEL";
        
        $v_cm= CertificadoMedico::where('id_ficha', '=' ,$id)->firstOrFail();
        if ($v_cm->fecha_de_vencimiento != null ) $vencimiento_certificado_medico = Carbon::parse($v_cm->fecha_de_vencimiento)->format('d/m/Y');
        else $vencimiento_certificado_medico = "NO PRESENTO";

        $lineas=DB::table('telefonos as t')
        ->join('lineas_telefonica as l','t.id_linea_telefonica','=','l.id')
        ->select('t.numero','t.tipo_telefono','l.linea as linea')
        ->where('t.id_usuario','=',$ficha->idusuario)
        ->get();

        return response()->json([
            'ficha' => $ficha,
            'unidad' => $unidad,
            'lineas' => $lineas,
            'vencimientoCertificadoM' => $vencimiento_certificado_medico,
            'vencimientoCertificadoAR' => $vencimiento_certificado_alumno,
            'ultimo_arancel' => $vencimiento_ultimo_arancel,
            'fecha_de_nacimiento' => Carbon::parse($ficha->fecha_de_nacimiento)->format('d/m/Y')
        ]);
    }

    public function obtenerInfoParaModalArancel($id){
        
        $ficha = DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->join('categorias as c','f.id_categoria','=','c.id')
        ->join('estados as e','f.id_estado','=','e.id')
        ->select('f.id as idficha','f.fecha as fecha','f.lu_legajo','f.lugar_de_trabajo','f.ultimo_arancel','f.id_usuario as idusuario','f.id_unidad_academica',
                    'e.estado as estado','c.categoria as categoria','f.id_categoria',
                    DB::raw('CONCAT(u.apellido," ",u.nombre)AS nombre_usuario'), 'u.dni', 'u.fecha_de_nacimiento', 'u.email','u.domicilio','u.foto')
        ->where('f.id',$id)
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
                $nroValido=true;
                $importe = $arancel_por_categoria->importe;
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
                $importe ="0"; 
                $mensaje = 'Comuníquese con un administrador porque no se realizó el registro de importe para la categoria '.$ficha->categoria.' en Gestión de Importes.';
            }
            
        } 

        return response()->json([
            'ficha' => $ficha,
            'mensaje' => $mensaje,
            'importe' => $importe,
            'nroValido' => $nroValido
        ]);
    }
}
