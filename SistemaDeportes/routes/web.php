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
Route::put('user/{id}','UserController@update')->name('user.update');
//Route::post('user/actualiza','UserController@actualizar')->name('user.actualizar');
//Route::resource('/user','UserController');

//  FICHAS DE USUARIO 
Route::get('ficha/create/{idUsuario}','FichaController@create');
Route::post('ficha/create/{idUsuario}','FichaController@store')->name('ficha.store');
Route::get('fichas/{id}','FichaController@mostrarFichasDeUsuario')->name('fichas.mostrar');
Route::get('ficha/edit/estudiante/{idFicha}','FichaController@editFichaEstudiante');
Route::get('ficha/edit/familiar/{idFicha}','FichaController@editFichaFamiliar');
Route::get('ficha/edit/profesional/{idFicha}','FichaController@editFichaProfesional');
Route::patch('ficha/edit/familiar/{idFicha}','FichaController@updateFichaFamiliar')->name('ficha.familiar.update');
Route::patch('ficha/edit/profesional/{idFicha}','FichaController@updateFichaProfesional')->name('ficha.profesional.update');
Route::patch('ficha/edit/estudiante/{idFicha}','FichaController@updateFichaEstudiante')->name('ficha.estudiante.update');
//  CARNET DEL USUARIO
Route::get('carnet/estudiante/{id}','CarnetController@generarCarnetEstudiante')->name('carnet.estudiante');
Route::get('carnet/profesional/{id}','CarnetController@generarCarnetProfesional')->name('carnet.profesional');
Route::get('carnet/familiar/{id}','CarnetController@generarCarnetFamiliar')->name('carnet.familiar');