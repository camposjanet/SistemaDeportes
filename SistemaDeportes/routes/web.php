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

Route::get('/admin','AdministradorController@index');

Auth::routes();

Route::get('/inicio', 'HomeController@index')->name('inicio');

// * SOCIOS
Route::get('socio/create','SocioController@create');
Route::post('socio/create','SocioController@store')->name('socio.store');
Route::get('socios','SocioController@index')->name('socio.index');

//Route::resource('socio','SocioController');
Route::post('login','Auth\LoginController@login')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');
