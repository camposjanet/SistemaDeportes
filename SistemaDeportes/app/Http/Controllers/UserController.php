<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	*/

	public function index(Request $request)
	{
		if($request->ajax()){
			$data = User::latest()->get();
			return Datatables::of($data)
					->addIndexColumn()
					->addColumn('action',function($row){
							$btn= '<>'
					})
		}
	}
}
