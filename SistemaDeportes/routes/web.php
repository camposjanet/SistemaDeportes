<?php
use App\User;
use App\Role;
use Illuminate\Support\Facades\Redirect;

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
Route::get('usuario/{id}/edit','UsuarioController@edit')->name('usuario.edit');
Route::patch('usuario/{id}','UsuarioController@update_usuario')->name('usuario.update');


//Route::resource('socio','SocioController');
Route::post('login','Auth\LoginController@login')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');

// OPERARIOS
Route::get('users','UserController@index')->name('user.index');
Route::get('user/create','UserController@create');
Route::get('user/{id}/edit','UserController@edit')->name('user.edit');
Route::post('user/create','UserController@store')->name('user.store');
Route::put('user/{id}','UserController@update')->name('user.update');
Route::delete('user/delete/{id}','UserController@delete');
Route::get('user/{id}/password', 'UserController@password')->name('user.password');
Route::post('user/{id}/updatepassword', 'UserController@updatePassword')->name('user.updatepassword');
Route::get('user/recoverpassword','EmailController@create')->name('email.create');
Route::post('user/sendemail','EmailController@sendEmail')->name('recuperar.contraseña');
Route::get('user/edit/defaultpassword','UserController@editDefaultPassword')->name('user.edit.default.password');
Route::post('user/defaultpassword','UserController@changeDefaultPassword')->name('user.defaultPassword');
Route::get('user/irmodificarcontrasenia', 'UserController@irmodificarcontrasenia')->name('user.irmodificarcontrasenia');
Route::post('user/modificarcontrasenia/{id}','UserController@modificarcontrasenia')->name('user.modificarcontrasenia');

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
Route::get('fichas/show/{id}','FichaController@show');
Route::get('fichas/info/{id}','FichaController@obtenerInfoParaModalArancel');

//  CARNET DEL USUARIO
Route::get('carnet/estudiante/{id}','CarnetController@generarCarnetEstudiante')->name('carnet.estudiante');
Route::get('carnet/profesional/{id}','CarnetController@generarCarnetProfesional')->name('carnet.profesional');
Route::get('carnet/familiar/{id}','CarnetController@generarCarnetFamiliar')->name('carnet.familiar');

//DAR DE BAJA USUARIO
Route::delete('usuario/delete/{id}','UsuarioController@deleteUsuario');

//ARANCELES
Route::post('ficha/arancel/create/{idUser}/{idFicha}','ArancelController@store')->name('arancel.store');
Route::get('arancel/index','ArancelController@index')->name('arancel.index');
Route::get('arancel/index/{nro}','ArancelController@buscarNroCarnet')->name('arancel.buscar');
Route::post('arancel/index/create/{idFicha}','ArancelController@registrarArancelDesdeModulo')->name('arancel.index.store');

// ASISTENCIA
Route::get('asistencia/menuasistencia', 'AsistenciasController@index')->name('asistencia.index');
Route::get('asistencia/cabeceraplanilla','AsistenciasController@index_cabecera_planilla')->name('asistencia.cabecera');
Route::get('asistencia/buscarcarnet/{id}','Planilla_asistenciasController@mostrar_fichas')->name('asistencia.mostrar');
Route::get('asistencia/crear_asistencia/{idAsistencia}/{idficha}', 'Planilla_asistenciasController@create')->name('asistencia.registrar');
Route::get('asistencia/estado_documentacion/{id}', 'Planilla_asistenciasController@estado_documentacion')->name('asistencia.estado');
Route::get('asistencia/mostrar_asistencia_turno', 'Planilla_asistenciasController@mostrar_asistencia_turno');
Route::get('asistencia/mostrar_planilla','AsistenciasController@show')->name('asistencia.mostrar_planilla');
Route::get('asistencia/buscar_asistencia/{id}','Planilla_asistenciasController@buscar_asistencia')->name('asistencia.buscar');
Route::get('asistencia/mostrar_asistencia/{id}','Planilla_asistenciasController@mostrar_asistencia')->name('asistencia.ver');
Route::get('asistencia/crear_asistencia_sin_arancel/{idAsistencia}/{idficha}','Planilla_asistenciasController@crear_asistencia_sin_arancel');
Route::get('asistencia/estado_documentacion_sinarancel/{id}', 'Planilla_asistenciasController@estado_documentacion_sinarancel')->name('asistencia.estadosinarancel');

//CONFIGURACION
Route::get('configuracion', 'ConfiguracionController@showMenu')->name('configuracion.menu');

//NOTIFICACIONES
Route::get('notificaciones','NotificacionArancelController@index')->name('Notificaciones.index');
Route::get('notificaciones/create','NotificacionArancelController@create')->name('notificaciones.create');
Route::post('notificaciones/store/{idUser}','NotificacionArancelController@store')->name('Notificaciones.store');

//GESTION DE IMPORTES
Route::get('configuracion/importes/create','ImporteController@create')->name('importe.create');
Route::post('configuracion/importes/create','ImporteController@store')->name('importe.store');
Route::get('configuracion/importes','ImporteController@index')->name('importe.index');