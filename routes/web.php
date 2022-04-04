<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Use App\Models\Eje;


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



Route::get('/')->middleware('loginCheck');


Route::get('/index', function () {
    return view('layouts.index');
});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => 'prevent-back-history'],function(){

Auth::routes();
//-------------------------->ADMINISTRADOR<----------------------------------

Route::get('/inicio','AdministradorController@index')->middleware('EsAdmin');
//-------------------------->ADMINISTRADOR->USUARIOS<----------------------------------
Route::get('/usuarios', 'UserController@index')->name('user.index')->middleware('EsAdmin');
Route::post('/usuarios/nuevo_usuario','UserController@store')->name('user.store')->middleware('EsAdmin');
Route::put('/usuarios/editar_usuario/{user}','UserController@update')->name('user.update')->middleware('EsAdmin');
Route::put('/usuarios/editar_password/{user}','UserController@update_password')->name('user.update_password')->middleware('EsAdmin');
Route::delete('/usuarios/eliminar_usuario/{user_id}','UserController@destroy')->name('user.destroy')->middleware('EsAdmin');
//-------------------------->ADMINISTRADOR->EJES<----------------------------------
Route::get('/ejes', 'EjeController@index')->name('ejes.index');
Route::post('/ejes/nuevo_eje','EjeController@store')->name('eje.store');
Route::put('/ejes/editar_eje/{eje}','EjeController@update')->name('eje.update');
Route::delete('/ejes/eliminar_eje/{eje_id}','EjeController@destroy')->name('eje.destroy');
//-------------------------->ADMINISTRADOR->ESTRATEGIAS<----------------------------------

Route::get('/estrategias', 'EstrategiaController@index')->name('estrategias.index');
Route::get('/estrategias/nueva_estrategia', 'EstrategiaController@create')->name('estrategia.create');
Route::post('/estrategias/nueva_estrategia','EstrategiaController@store')->name('estrategia.store');
Route::get('/estrategias/editar_estrategia/{estrategia}','EstrategiaController@edit')->name('estrategia.edit');
Route::put('/estrategias/editar_estrategia/{estrategia}','EstrategiaController@update')->name('estrategia.update');
Route::delete('/estrategias/eliminar_estrategia/{estrategia_id}','EstrategiaController@destroy')->name('estrategia.destroy');
//-------------------------->ADMINISTRADOR->ACCIONES<----------------------------------
Route::get('/acciones', 'AccionController@index')->name('acciones.index');
Route::get('/acciones/nueva_accion', 'AccionController@create')->name('accion.create');
Route::post('/acciones/nueva_accion','AccionController@store')->name('accion.store');
Route::get('/acciones/editar_accion/{accion}','AccionController@edit')->name('accion.edit');
Route::put('/acciones/editar_accion/{accion}','AccionController@update')->name('accion.update');
Route::delete('/acciones/eliminar_accion/{accion_id}','AccionController@destroy')->name('accion.destroy');
//-------------------------->ADMINISTRADOR->SUJETO<----------------------------------
Route::post('panel-seguimiento/{user}', 'UserController@seguimiento')->name('sujeto.seguimiento');
Route::post('panel-seguimiento/{user}/{eje}',  'UserController@seguimiento_eje')->name('sujeto.seguimiento.eje');
Route::post('panel-seguimiento/{user}/{eje}/{compromiso}',  'UserController@seguimiento_eje_accion')->name('sujeto.seguimiento.eje.accion');
Route::post('descargar/{id}','UserController@descargar_archivo')->name('descargar_archivo');

//------------------------>ADMINISTRADOR->REPORTES<----------------------------------------------------

Route::get('/reportes', 'ReportsController@index')->name('reportes.index');
Route::get('reportes-pdf/{user}', 'UserController@user_pdf')->name('sujeto.seguimiento.pdf');
Route::post('reportes-pdf/marcas-de-agua', 'ReportsController@store')->name('reportes.marcas.store');

//-------------------------->SUJETO<----------------------------------}
Route::get('panel-evidencias','UserController@evidencias_sujeto')->name('evidencia')->middleware('esSujeto');
Route::post('panel-evidencias','UserController@evidencias_sujeto')->name('evidencias')->middleware('esSujeto');
Route::post('panel-evidencias/{eje}','UserController@evidencias_sujeto_eje')->name('evidencias_eje')->middleware('esSujeto');
Route::put('panel-evidencias/{user}/{eje}/{id}','UserController@cargar_evidencia')->name('cargar_evidencia')->middleware('esSujeto');
Route::post('/subir-evidencia/{user}/{eje}/{id}','UserController@pantalla_evidencia')->name('pantalla_evidencia')->middleware('esSujeto');
Route::delete('panel-evidencias/{user}/{eje}/{id}','UserController@eliminar_evidencia')->name('evidencia.eliminar')->middleware('esSujeto');
//---------------------->COMPROMISOS,-------------------------------
//Route::get('/home','UserController@index')->middleware('auth');
Route::get('/compromisos', 'CompromisoController@index')->name('compromiso.index')->middleware('esSujeto');
Route::get('/compromisos/nuevo_compromiso', 'CompromisoController@create')->name('compromiso.create')->middleware('esSujeto');
Route::post('/compromisos/nuevo_compromiso','CompromisoController@store')->name('compromiso.store')->middleware('esSujeto');
Route::put('/compromisos/editar_compromiso/{compromiso}','CompromisoController@update')->name('compromiso.update')->middleware('esSujeto');
Route::delete('/compromisos/eliminar_compromiso/{compromiso}','CompromisoController@destroy')->name('compromiso.destroy')->middleware('esSujeto');
//---------------------->EVIDENCIAS-------------------------------
// }); //middleware PreventBackHistory
