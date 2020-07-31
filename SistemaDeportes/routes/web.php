<?php
use App\User;
use App\Role;

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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/inicio', 'HomeController@index')->name('inicio');

//  USUARIOS (antes era socios)
Route::get('usuario/create','UsuarioController@create');
Route::post('usuario/create','UsuarioController@store')->name('usuario.store');
Route::get('usuarios','UsuarioController@index')->name('usuario.index');

//Route::resource('socio','SocioController');
Route::post('login','Auth\LoginController@login')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');

// OPERARIOS
Route::get('users','UserController@index')->name('user.index');
Route::get('user/create','UserController@create');
Route::get('user/{id}/edit','UserController@edit')->name('user.edit');
Route::post('user/create','UserController@store')->name('user.store');
//Route::post('user/{id}','UserController@update')->name('user.update');
Route::post('user/actualiza','UserController@actualizar')->name('user.actualizar');
//Route::resource('/user','UserController');

//  FICHAS DE USUARIO 
Route::get('ficha/create/{idUsuario}','FichaController@create');
Route::post('ficha/create/{idUsuario}','FichaController@store')->name('ficha.store');
