<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubMenuController extends Controller
{
    public function index_salamuscualcion(){
    	return view('SubMenu.salamusculacion');
    }
    public index_albergue(){
    	return view('SubMenu.albergue')
    }
}
