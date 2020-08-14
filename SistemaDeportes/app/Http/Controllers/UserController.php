<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UserRequest;
use App\Http\Requests\OperarioRequest;
use Illuminate\Http\Request;


use Illuminate\Support\Collection;

use App\Estados;
use App\Role;

use DB;

use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users=DB::table('users as u')
        ->join('estados as e','u.id_estado','=','e.id')
		->join('role_user as ru','u.id','=','ru.user_id')
		->join('roles as r','r.id','=','ru.role_id')
        ->select('u.id','u.name','u.email','r.nombre_rol as nombre_rol','e.estado as estado')
        ->get();
		if(request()->ajax()) {
            return datatables()->of($users)
            ->addColumn('action', 'user.action_buton')
            ->rawColumns(['action'])
            ->make(true);
        }  
		return view('user.index');
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$roles=DB::table('roles')->get();
		return view("user.create")->with('roles',$roles);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OperarioRequest $request)
    {
		$idEstado=DB::table('estados as e')->where('e.estado','=','ACTIVO')->value('id');

		$user= new User();
		$user->name= $request->get('name');
		$user->email= $request->get('email');
		$user->password= bcrypt($request->get('password')); 

		$role_id= $request->get('role_id'); 

		$user->id_estado= $idEstado;

		if($user->save()){
			if($role_id == 1){
				$rol_admin= Role::where('nombre_rol','Administrador')->first();
				$user->roles()->attach($rol_admin);
			}
			else{
				if($role_id == 2){		
					$rol_oper = Role::where('nombre_rol','Operario')->first();
					$user->roles()->attach($rol_oper);
				}
				else{
					if($role_id == 3){
						$rol_prof= Role::where('nombre_rol','Profesor')->first();
						$user->roles()->attach($rol_prof);
					}
				}
			}
			return Redirect::to('users');
		} 
	}

	public function edit($id){

			$user= User::findOrFail($id);
			return view("user.edit", compact("user"));
	}

	public function update(OperarioRequest $request, $id){
		$user= User::findOrFaild($id);
		$user->update($request->all()); 
		/*$user->name= $request->name;
		$user->email= $request->email;
		if ($user->save()){
			return Redirect::to('users');
		}*/

		return Redirect::to('users');
		
	}
}
