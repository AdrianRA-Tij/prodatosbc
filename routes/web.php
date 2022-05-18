<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
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
})->name('index');


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => 'prevent-back-history'],function(){

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::POST('/logout', 'Auth\LogoutController@perform')->name('logout.perform');
 });
//-------------------------->ADMINISTRADOR<----------------------------------

Route::get('/inicio','AdministradorController@index')->middleware('EsAdmin');
//-------------------------->ADMINISTRADOR->USUARIOS<----------------------------------
Route::get('/usuarios', 'UserController@index')->name('user.index')->middleware('EsAdmin');
Route::post('/usuarios/nuevo_usuario','UserController@store')->name('user.store')->middleware('EsAdmin');
Route::put('/usuarios/editar_usuario/{user}','UserController@update')->name('user.update')->middleware('EsAdmin');
Route::put('/usuarios/editar_password/{user}','UserController@update_password')->name('user.update_password')->middleware('EsAdmin');
Route::delete('/usuarios/eliminar_usuario/{user_id}','UserController@destroy')->name('user.destroy')->middleware('EsAdmin');
//-------------------------->ADMINISTRADOR->EJES<----------------------------------
Route::get('/ejes', 'EjeController@index')->name('ejes.index')->middleware('EsAdmin');
Route::post('/ejes/nuevo_eje','EjeController@store')->name('eje.store')->middleware('EsAdmin');
Route::put('/ejes/editar_eje/{eje}','EjeController@update')->name('eje.update')->middleware('EsAdmin');
Route::delete('/ejes/eliminar_eje/{eje_id}','EjeController@destroy')->name('eje.destroy')->middleware('EsAdmin');
//-------------------------->ADMINISTRADOR->PROBLEMATICAS<----------------------------------
Route::get('/problematicas', 'ProblematicasController@index')->name('problematicas.index')->middleware('EsAdmin');
Route::get('/problematicas/nueva_problematica', 'ProblematicasController@create')->name('problematica.create')->middleware('EsAdmin');
Route::post('/problematicas/nueva_problematica','ProblematicasController@store')->name('problematica.store')->middleware('EsAdmin');
Route::get('/problematicas/editar_problematica/{problematica}','ProblematicasController@edit')->name('problematica.edit')->middleware('EsAdmin');
Route::put('/problematicas/editar_problematica/{problematica}','ProblematicasController@update')->name('problematica.update')->middleware('EsAdmin');
Route::delete('/problematicas/eliminar_problematica/{problematica_id}','ProblematicasController@destroy')->name('problematica.destroy')->middleware('EsAdmin');
//-------------------------->ADMINISTRADOR->ESTRATEGIAS<----------------------------------

Route::get('/estrategias', 'EstrategiaController@index')->name('estrategias.index')->middleware('EsAdmin');
Route::get('/estrategias/nueva_estrategia', 'EstrategiaController@create')->name('estrategia.create')->middleware('EsAdmin');
Route::post('/estrategias/nueva_estrategia','EstrategiaController@store')->name('estrategia.store')->middleware('EsAdmin');
Route::get('/estrategias/editar_estrategia/{estrategia}','EstrategiaController@edit')->name('estrategia.edit')->middleware('EsAdmin');
Route::put('/estrategias/editar_estrategia/{estrategia}','EstrategiaController@update')->name('estrategia.update')->middleware('EsAdmin');
Route::delete('/estrategias/eliminar_estrategia/{estrategia_id}','EstrategiaController@destroy')->name('estrategia.destroy')->middleware('EsAdmin');
//-------------------------->ADMINISTRADOR->ACCIONES<----------------------------------
Route::get('/acciones', 'AccionController@index')->name('acciones.index')->middleware('EsAdmin');
Route::get('/acciones/nueva_accion', 'AccionController@create')->name('accion.create')->middleware('EsAdmin');
Route::post('/acciones/nueva_accion','AccionController@store')->name('accion.store')->middleware('EsAdmin');
Route::get('/acciones/editar_accion/{accion}','AccionController@edit')->name('accion.edit')->middleware('EsAdmin');
Route::put('/acciones/editar_accion/{accion}','AccionController@update')->name('accion.update')->middleware('EsAdmin');
Route::delete('/acciones/eliminar_accion/{accion_id}','AccionController@destroy')->name('accion.destroy')->middleware('EsAdmin');
//-------------------------->ADMINISTRADOR->SUJETO<----------------------------------
Route::post('panel-seguimiento/{user}', 'UserController@seguimiento')->name('sujeto.seguimiento')->middleware('EsAdmin');
Route::post('panel-seguimiento/{user}/{eje}',  'UserController@seguimiento_eje')->name('sujeto.seguimiento.eje')->middleware('EsAdmin');
Route::post('panel-seguimiento/{user}/{eje}/{compromiso}',  'UserController@seguimiento_eje_accion')->name('sujeto.seguimiento.eje.accion')->middleware('EsAdmin');
Route::post('descargar/{id}','UserController@descargar_archivo')->name('descargar_archivo')->middleware('EsAdmin');

//------------------------>ADMINISTRADOR->REPORTES<----------------------------------------------------

Route::get('/reportes', 'ReportsController@index')->name('reportes.index')->middleware('EsAdmin');
Route::get('reportes-pdf/{user}', 'UserController@user_pdf')->name('sujeto.seguimiento.pdf')->middleware('EsAdmin');
Route::post('reportes-pdf/marcas-de-agua', 'ReportsController@store')->name('reportes.marcas.store')->middleware('EsAdmin');

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
