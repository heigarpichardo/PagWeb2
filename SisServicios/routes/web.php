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
    //return view('welcome');
    return view('auth/login');
});

Route::get('/admin', function () {
    return view('/layouts/admin');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
route::get('/procesos/Ventas/{id}','VentasController@createp')->name('createp');

Route::resource('direccion/ciudades','CiudadController');

Route::resource('procesos/inscripcion','InscripcionController');
Route::resource('procesos/cobros','CobrosController');
//Route::resource('procesos/Servicios','ProServiciosController');
Route::resource('procesos/Ventas','VentasController');

Route::resource('Mantenimientos/Servicios','ServiciosController');
Route::resource('Mantenimientos/Condiciones','CondicionesController');
Route::resource('Mantenimientos/Tipopersona','TipoPersonaController');
Route::resource('Mantenimientos/Tasaitbis','TasaItbisController');
Route::resource('Mantenimientos/Tipotelefono','TipoTelefonoController');
Route::resource('Mantenimientos/Telefonos','TelefonosController');
Route::resource('Mantenimientos/Clientes','ClientesController');
Route::resource('Mantenimientos/Comprobantes','ComprobantesController');

Route::get('generate-pdf','HomeController@generatePDF');
Route::get('generate-pdf','VentasController@create');
