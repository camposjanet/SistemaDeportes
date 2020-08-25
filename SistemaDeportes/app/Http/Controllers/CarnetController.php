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
    public function generarReporteDelCarnet($idFicha){
        $ficha =Ficha::findOrFail($idFicha);
        $usuario =Usuario::findOrFail($ficha->id_usuario);

        

        $html = view('carnet.reporte')->with('ficha',$ficha)
                                    ->with('usuario',$usuario);
        $mpdf = new mPDF([
            "format" => "A4",
        ]);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output('carnet.pdf', "I");
    }
}
