<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function showMenu()
    {
        return view('configuracion.menu');
    }
}
