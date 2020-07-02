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
    return view('welcome');
});

Auth::routes();

Route::get('/inicio', 'HomeController@index')->name('inicio');

// * SOCIOS
Route::get('socio/create','SocioController@create');
Route::post('socio/create','SocioController@store')->name('socio.store');
Route::get('socios','SocioController@index')->name('socio.index');
