<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlbergueController extends Controller
{
    public function index(){
    	return view('Albergue.menu_albergue');
    }
}
