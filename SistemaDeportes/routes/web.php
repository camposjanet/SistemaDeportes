<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin','AdministradorController@index');

Route::get('/usuario/{id}/role', function($id){

	$user=user::find($id);

	foreach($user->roles as $role){
		return $role->nombre_rol;
	}

});

Auth::routes();

Route::get('/inicio', 'HomeController@index')->name('inicio');
