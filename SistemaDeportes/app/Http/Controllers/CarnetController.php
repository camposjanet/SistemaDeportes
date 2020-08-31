<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mpdf\Mpdf;

use DB;
use App\Usuario;
use App\Ficha;
use App\Estados;
use App\Categoria;
use App\UnidadAcademica;

class CarnetController extends Controller
{
    public function generarCarnetEstudiante($idFicha){
        $ficha = DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->join('categorias as c','f.id_categoria','=','c.id')
        ->join('unidades_academicas as ua','f.id_unidad_academica','=','ua.id')
        ->select('f.id','c.categoria as categoria','f.lu_legajo as lu','ua.unidad as unidad','u.nombre as nombre','u.apellido as apellido','u.dni as dni', 'u.foto as foto')
        ->where('f.id',$idFicha)
        ->first();
        $html = view('carnet.carnetEstudiante')->with('ficha',$ficha);
        $mpdf = new mPDF([//'format' => [140, 100]
            "format" => "A4",
        ]);
        //$mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output('carnet.pdf', "I");
    }

    public function generarCarnetProfesional($idFicha){

        $ficha = DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->join('categorias as c','f.id_categoria','=','c.id')
        ->select('f.id','c.categoria as categoria','f.lu_legajo as legajo','f.lugar_de_trabajo as lugar','u.nombre as nombre','u.apellido as apellido','u.dni as dni', 'u.foto as foto')
        ->where('f.id',$idFicha)
        ->first();

        $html = view('carnet.carnetProfesional')->with('ficha',$ficha);
        $mpdf = new mPDF([//'format' => [140, 100]
            "format" => "A4",
        ]);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output('carnet.pdf', "I");
    }
    public function generarCarnetFamiliar($idFicha){
        $ficha = DB::table('fichas as f')
        ->join('usuarios as u','f.id_usuario','=','u.id')
        ->join('categorias as c','f.id_categoria','=','c.id')
        ->select('f.id','c.categoria as categoria','u.nombre as nombre','u.apellido as apellido','u.dni as dni', 'u.foto as foto')
        ->where('f.id',$idFicha)
        ->first();
        $documentacion = DB::table('documentacion_familiar as df')
        ->join('estados_de_documento as e','e.id','=','df.id_estado_documento')
        ->select('df.id','nombre_documentacion','nombre_familiar','legajo_familiar','df.id_estado_documento as presentoDF')
        ->where('df.id_ficha',$idFicha)
        ->first();

        $html = view('carnet.carnetFamiliar')->with('ficha',$ficha)
                                    ->with('documentacion',$documentacion);
        $mpdf = new mPDF([
            "format" => "A4",
        ]);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output('carnet.pdf', "I");
    }
}
